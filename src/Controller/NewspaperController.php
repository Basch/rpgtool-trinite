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
     * @Route("joueur/journal/liste", name="newspaper.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/journal/liste", name="newspaper.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/journal/{itemSlug}", name="newspaper.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request );}

    /**
     * @Route("nouveau/journal", name="newspaper.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }


    /**
     * @Route("voir/journal/{itemSlug}", name="newspaper.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/journal/{itemSlug}", name="newspaper.edit")
     */
    public function editItem( string $itemSlug, Request $request )
    {
        return parent::editItem( $itemSlug, $request );
    }
}
