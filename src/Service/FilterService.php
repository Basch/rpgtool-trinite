<?php

namespace App\Service;

use App\Entity\Campaign;
use App\Entity\FilterCharacter;
use App\Entity\PlayerCharacter;
use App\Model\FiltrableItemInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class FilterService
{
    private $em;
    private $parser;
    private $userData;

    public function __construct( ClassParserService $parser, UserDataService $userData, EntityManagerInterface $entityManager )
    {
        $this->em = $entityManager;
        $this->parser = $parser;
        $this->userData = $userData;
    }

    /**
     * @return ArrayCollection|FilterCharacter[]
     */
    public function getFilterListFromCampaign( FiltrableItemInterface $item, Campaign $campaign = null ): Collection
    {
        $list = $this->em->getRepository( FilterCharacter::class )->findBy( [
            'item_type' => $this->parser->getClass( $item ),
            'item_id' => $item->getId(),
            'campaign' => $campaign
        ] );

        return Utils::ArrayToCollection( $list );
    }

    public function getOwners( FiltrableItemInterface $item, Campaign $campaign = null ): Collection
    {
        if( !$campaign ){
            $campaign = $this->userData->getCampaign();
        }

        $filters = $this->getFilterListFromCampaign( $item, $campaign );
        $return =  new ArrayCollection();
        foreach ( $filters as $filter ){
            if( $filter->getOwned() ) {
                $return->add( $filter->getCharacter() );
            }
        }

        return $return;
    }

    public function getViewers( FiltrableItemInterface $item, Campaign $campaign = null ): Collection
    {
        if( !$campaign ){
            $campaign = $this->userData->getCampaign();
        }

        $filters = $this->getFilterListFromCampaign( $item, $campaign );
        $return =  new ArrayCollection();
        foreach ( $filters as $filter ){
            if( $filter->getVisible() ) {
                $return->add( $filter->getCharacter() );
            }
        }

        return $return;
    }


    /**
     * @return ArrayCollection|FilterCharacter[]
     */
    public function getFilterListFromCharacter( string $class, PlayerCharacter $character = null ): ?Collection{
        if( !$character ){
            $character = $this->userData->getCharacter();
        }

        $list = $this->em->getRepository( FilterCharacter::class )->findBy( [
            'item_type' => $class,
            'playerCharacter' => $character,
            'campaign' => $this->userData->getCampaign(),
        ] );

        return Utils::ArrayToCollection( $list );
    }

    /**
     * @return Collection|FiltrableItemInterface[]
     */
    public function getVisibleItems( string $class, PlayerCharacter $character = null ): ?Collection{

        $filters = $this->getFilterListFromCharacter( $class, $character );

        if( !$filters || $filters->isEmpty() ) return null;

        $return =  new ArrayCollection();
        foreach( $filters as $filter ){
            $item = $this->getItem( $filter );
            if( $filter->getVisible() || $filter->getOwned() || $item->getWriter() == $this->userData->getCharacter() ){
                $return->add( $this->getItem( $filter ) );
            }
        }
        return $return;
    }

    public function getItem( FilterCharacter $filter ): FiltrableItemInterface {
        /** @var FiltrableItemInterface $item */
        $item = $this->em->getRepository( $filter->getItemType() )->find( $filter->getItemId() ); // TODO : Eviter requette
        return $item;
    }

    private function getFilterByItemAndCharacter( FiltrableItemInterface $item, PlayerCharacter $character = null ): ?FilterCharacter {
        $class = $this->parser->getClass( $item );
        if( !$character ){
            $character = $this->userData->getCharacter();
        }

        /** @var FilterCharacter $filter */
        $filter = $this->em->getRepository( FilterCharacter::class )->findOneBy( [ 'item_id' => $item->getId(), 'item_type' => $class, 'playerCharacter' => $character ] );
        return $filter;

    }

    public function hasItem( FiltrableItemInterface $item, PlayerCharacter $character = null ): bool {

        $filter = $this->getFilterByItemAndCharacter( $item, $character );

        if( !$filter ) return false;

        return $filter->getOwned();
    }

    public function viewItem( FiltrableItemInterface $item, PlayerCharacter $character = null ): bool {

        $filter = $this->getFilterByItemAndCharacter( $item, $character );

        if( !$filter ) return false;

        return $filter->getOwned() || $filter->getVisible();
    }

    private function getItemFunctionName( string $class, FilterCharacter $filter ) {
        $function_name = 'get'.$class;
        if( !is_callable( [ $filter, $function_name ]) ) { return null; }

        return $function_name;
    }

//    private function getListFunctionName( string $class, PlayerCharacter $character ) {
//        $function_name = 'getFilter'.$class.'s';
//        if( !is_callable( [ $character, $function_name ]) ) { return null; }
//
//        return $function_name;
//    }

    public function updateFilter( FiltrableItemInterface $item ) {

        dump($item);
        $item->setWriter(null);
        $this->em->persist( $item );
        $this->em->flush();

        $campaign = $this->userData->getCampaign();
        $characters = $campaign->getCharacters();
        $filters = $this->getFilterListFromCampaign( $item, $campaign );

        foreach ( $characters as $character ){

            $found = false;
            foreach ( $filters as $filter ) {
                if( $character->getId() == $filter->getCharacter()->getId() ) {
                    $found = true;
                }
            }

            if( !$found ){
                $filter = new FilterCharacter();
                $filter
                    ->setCampaign( $campaign )
                    ->setItemType( $this->parser->getClass( $item ) )
                    ->setItemId( $item->getId() )
                    ->setCharacter( $character )
                    ->setVisible( false )
                    ->setOwned( false );
                ;
                $this->em->persist( $filter );
            }
        }

        $this->em->flush();
    }

    public function updateOwners( FiltrableItemInterface $item, array $owners_id, Campaign $campaign = null ) {
        if( !$campaign ){
            $campaign = $this->userData->getCampaign();
        }

        $filters = $this->getFilterListFromCampaign( $item, $campaign );

        foreach ( $filters as $filter ){
            if( in_array( $filter->getCharacter()->getId(), $owners_id ) ){
                $filter->setOwned(true );
            }
            else {
                $filter->setOwned( false );
            }
        }

    }

    public function updateViewers( FiltrableItemInterface $item, array $owners_id, Campaign $campaign = null ) {
        if( !$campaign ){
            $campaign = $this->userData->getCampaign();
        }

        $filters = $this->getFilterListFromCampaign( $item, $campaign );

        foreach ( $filters as $filter ){
            if( in_array( $filter->getCharacter()->getId(), $owners_id ) ){
                $filter->setVisible(true );
            }
            else {
                $filter->setVisible( false );
            }
        }

    }
}