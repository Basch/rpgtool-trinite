<?php

namespace App\Controller;

use App\Entity\Aura;
use App\Form\AuraType;
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
     * @Route("joueur/aura/liste", name="player.aura.list")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/aura/liste", name="master.aura.list")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/aura/{itemSlug}", name="aura.show")
     */
    public function show( string $itemSlug, Request $request ) { return parent::show( $itemSlug, $request ); }

    /**
     * @Route("joueur/aura/nouveau", name="aura.new")
     */
    public function addItem( Request $request ) { return parent::addItem( $request ); }

    /**
     * @Route("joueur/aura/{itemSlug}", name="player.aura.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("maitre/aura/{itemSlug}", name="master.aura.show")
     */
    public function editItem( string $itemSlug, Request $request ) { return parent::editItem( $itemSlug, $request ); }
}
