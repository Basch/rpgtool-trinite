<?php

namespace App\Controller;

use App\Entity\Newspaper;
use App\Form\Entities\NewspaperType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewspaperController extends GenericItemController
{

    protected function getEditForm(): string {
        return NewspaperType::class;
    }

    protected function getClass(): string {
        return Newspaper::class;
    }

    /**
     * @Route("/journal", name="newspaper")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/journal/liste", name="newspaper.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/journal/liste", name="player.newspaper.list")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/journal/liste", name="master.newspaper.list")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/journal/{itemSlug}", name="newspaper.show")
     */
    public function show( string $itemSlug, Request $request ) { return parent::show( $itemSlug, $request );}

    /**
     * @Route("joueur/journal/nouveau", name="newspaper.new")
     */
    public function addItem( Request $request, $item = null ) { return parent::addItem( $request ); }


    /**
     * @Route("joueur/journal/{itemSlug}", name="player.newspaper.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("maitre/journal/{itemSlug}", name="master.newspaper.show")
     */
    public function editItem( string $itemSlug, Request $request )
    {
        return parent::editItem( $itemSlug, $request );
    }
}
