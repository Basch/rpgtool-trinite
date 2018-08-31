<?php

namespace App\Controller;

use App\Entity\Aura;
use App\Form\Entities\AuraType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuraController extends GenericItemController
{

    protected function getEditForm(): string
    {
        return AuraType::class;
    }

    protected function getClass(): string
    {
        return Aura::class;
    }

    /**
     * @Route("/aura", name="aura")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/aura/liste", name="aura.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/aura/liste", name="aura.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/aura/liste", name="aura.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/aura/{itemSlug}", name="aura.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/aura", name="aura.new")
     */
    public function newItem( Request $request, $item = null ) { return parent::newItem( $request ); }

    /**
     * @Route("voir/aura/{itemSlug}", name="aura.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/aura/{itemSlug}", name="aura.edit")
     */
    public function editItem( string $itemSlug, Request $request ) { return parent::editItem( $itemSlug, $request ); }
}
