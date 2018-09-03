<?php

namespace App\Controller;

use App\Entity\NonPlayerCharacter;
use App\Form\Entities\NonPlayerCharacterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NPCController extends GenericItemController
{

    protected function getEditForm(): string {
        return NonPlayerCharacterType::class;
    }

    protected function getClass(): string {
        return NonPlayerCharacter::class;
    }

    /**
     * @Route("/pnj", name="nonplayercharacter")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/pnj/liste", name="nonplayercharacter.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/pnj/liste", name="nonplayercharacter.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/pnj/liste", name="nonplayercharacter.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/pnj/{itemSlug}", name="nonplayercharacter.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/pnj", name="nonplayercharacter.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }


    /**
     * @Route("voir/pnj/{itemSlug}", name="nonplayercharacter.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/pnj/{itemSlug}", name="nonplayercharacter.edit")
     */
    public function editItem( string $itemSlug, Request $request )
    {
        return parent::editItem( $itemSlug, $request );
    }
}
