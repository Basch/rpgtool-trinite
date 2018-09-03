<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Location;
use App\Form\Entities\AssetType;
use App\Form\Entities\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends GenericItemController
{

    protected function getEditForm(): string {
        return LocationType::class;
    }

    protected function getClass(): string {
        return Location::class;
    }

    /**
     * @Route("/lieu", name="location")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/lieu/liste", name="location.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/lieu/liste", name="location.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/lieu/liste", name="location.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/lieu/{itemSlug}", name="location.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/lieu", name="location.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }


    /**
     * @Route("voir/lieu/{itemSlug}", name="location.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/lieu/{itemSlug}", name="location.edit")
     */
    public function editItem( string $itemSlug, Request $request )
    {
        return parent::editItem( $itemSlug, $request );
    }
}
