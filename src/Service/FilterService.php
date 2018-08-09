<?php

namespace App\Service;

use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Model\FilterCharacterInterface;
use App\Model\FiltrableItemCharacterInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class FilterService
{
    private $parser;
    private $userData;

    public function __construct( ClassParserService $parser, UserDataService $userData )
    {
        $this->parser = $parser;
        $this->userData = $userData;
    }

    /**
     * @return ArrayCollection|FilterCharacterInterface[]
     */
    public function getFilterListFromCampaign( FiltrableItemCharacterInterface $item, Campaign $campaign = null ): Collection
    {
        $filters = $item->getFilterCharacter();

        $return =  new ArrayCollection();
        foreach ( $filters as $filter ){
            if( $filter->getCharacter()->getCampaign()->getId() == $campaign->getId() ) {
                $return->add( $filter );
            }
        }

        return $return;
    }

    public function getOwners( FiltrableItemCharacterInterface $item, Campaign $campaign = null ): Collection
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

    public function getViewers( FiltrableItemCharacterInterface $item, Campaign $campaign = null ): Collection
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

        $getList = $this->getListFunctionName( $class, $character );
        return $character->$getList();
    }

    public function getVisibleItems( string $class, PlayerCharacter $character = null ): ?Collection{

        $class = $this->parser->parseClass( $class );
        $filters = $this->getFilterListFromCharacter( $class, $character );
        $getItem = $this->getItemFunctionName( $class, $filters->first() );
        if( !$getItem ) return null;

        $return =  new ArrayCollection();
        foreach( $filters as $filter ){
            if( $filter->getVisible() || $filter->getOwned() ){
                $return->add( $filter->$getItem() );
            }
        }

        return $return;
    }


    public function hasItem( $item, PlayerCharacter $character = null ): bool {

        $class = $this->parser->getClass( $item );
        $filters = $this->getFilterListFromCharacter( $class , $character );
        $getItem = $this->getItemFunctionName( $class, $filters->first() );
        if( !$getItem ) return false;

        foreach( $filters as $filter ){
            if( $filter->$getItem()->getId() == $item->getId() && $filter->getOwned() ){
                return true;
            }
        }

        return false;
    }

    public function viewItem( $item, PlayerCharacter $character = null ): bool {

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

    private function getListFunctionName( string $class, PlayerCharacter $character ) {
        $function_name = 'getFilter'.$class.'s';
        if( !is_callable( [ $character, $function_name ]) ) { return null; }

        return $function_name;
    }


    public function updateOwners( FiltrableItemCharacterInterface $item, array $owners_id, Campaign $campaign = null ) {
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

    public function updateViewers( FiltrableItemCharacterInterface $item, array $owners_id, Campaign $campaign = null ) {
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