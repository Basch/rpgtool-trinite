<?php

namespace App\Controller;

use App\Entity\Verse;
use App\Form\Entities\VerseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VerseController extends GenericItemController
{

    protected function getEditForm(): string
    {
        return VerseType::class;
    }

    protected function getClass(): string
    {
        return Verse::class;
    }

    /**
     * @Route("/verset", name="verse")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/verset/liste", name="verse.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/verset/liste", name="verse.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/verset/liste", name="verse.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/verset/{itemSlug}", name="verse.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/verset", name="verse.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }

    /**
     * @Route("voir/verset/{itemSlug}", name="verse.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/verset/{itemSlug}", name="verse.edit")
     */
    public function editItem( string $itemSlug, Request $request ) { return parent::editItem( $itemSlug, $request ); }
}
