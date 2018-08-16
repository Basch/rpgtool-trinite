<?php

namespace App\Service;

use App\Entity\Campaign;
use App\Entity\FilterCharacter;
use App\Entity\PlayerCharacter;
use App\Model\FilterCharacterInterface;
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
     * @return ArrayCollection|FilterCharacterInterface[]
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
     * @return ArrayCollection|FilterCharacterInterface[]
     */
    public function getFilterListFromCharacter( string $class, PlayerCharacter $character = null ): ?Collection{
        if( !$character ){
            $character = $this->userData->getCharacter();
        }
dump( $this->userData->getCampaign() );
        $list = $this->em->getRepository( FilterCharacter::class )->findBy( [
            'item_type' => $class,
            'playerCharacter' => $character,
            'campaign' => $this->userData->getCampaign(),
        ] );
dump( $list );
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
            if( $filter->getVisible() || $filter->getOwned() ){
                $return->add( $this->getItem( $filter ) );
            }
        }
        dump( $return );
        return $return;
    }

    public function getItem( FilterCharacter $filter ): FiltrableItemInterface {
        //dump( $filter->getItemType() . ' - ' . $filter->getItemId() );
        /** @var FiltrableItemInterface $item */
        $item = $this->em->getRepository( $filter->getItemType() )->find( $filter->getItemId() );
        return $item;
    }


    public function hasItem( FiltrableItemInterface $item, PlayerCharacter $character = null ): bool {
        $class = $this->parser->getClass( $item );

        $filter = $this->em->getRepository( $class )->findOneBy( $item->getId() );


        return false;
    }

    public function viewItem( FiltrableItemInterface $item, PlayerCharacter $character = null ): bool {

        $class = $this->parser->getClass( $item );
        $filters = $this->getFilterListFromCharacter( $class , $character );
        $getItem = $this->getItemFunctionName( $class, $filters->first() );
        if( !$getItem ) return false;

        foreach( $filters as $filter ){
            if( $filter->$getItem()->getId() == $item->getId() && ( $filter->getOwned() || $filter->getVisible() ) ){
                return true;
            }
        }

        return false;
    }

    private function getItemFunctionName( string $class, FilterCharacterInterface $filter ) {
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