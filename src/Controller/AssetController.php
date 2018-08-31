<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\Entities\AssetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends GenericItemController
{

    protected function getEditForm(): string {
        return AssetType::class;
    }

    protected function getClass(): string {
        return Asset::class;
    }

    /**
     * @Route("/atout", name="asset")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/atout/liste", name="asset.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/atout/liste", name="asset.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/atout/liste", name="asset.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/atout/{itemSlug}", name="asset.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/atout", name="asset.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }


    /**
     * @Route("voir/atout/{itemSlug}", name="asset.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/atout/{itemSlug}", name="asset.edit")
     */
    public function editItem( string $itemSlug, Request $request )
    {
        return parent::editItem( $itemSlug, $request );
    }
}
