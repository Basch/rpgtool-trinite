<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
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
     * @Route("joueur/atout/liste", name="player.asset.list")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/atout/liste", name="master.asset.list")
     */
    public function listMaster() { return parent::listMaster(); }


    /**
     * @Route("/atout/{itemSlug}", name="asset.show")
     */
    public function show( string $itemSlug, Request $request ) { return parent::show( $itemSlug, $request );}

    /**
     * @Route("joueur/atout/{itemSlug}", name="player.asset.show")
     */
    public function showPlayer( string $itemSlug ) { return parent::showPlayer( $itemSlug ); }

    /**
     * @Route("maitre/atout/{itemSlug}", name="master.asset.show")
     */
    public function showMaster( string $itemSlug, Request $request )
    {
        return parent::showMaster( $itemSlug, $request );
    }
}
