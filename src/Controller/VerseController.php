<?php

namespace App\Controller;

use App\Entity\Verse;
use App\Form\VerseType;
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
     * @Route("joueur/verset/liste", name="player.verse.list")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/verset/liste", name="master.verse.list")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/verset/{itemSlug}", name="verse.show")
     */
    public function show( string $itemSlug, Request $request ) { return parent::show( $itemSlug, $request ); }

    /**
     * @Route("joueur/verset/{itemSlug}", name="player.verse.show")
     */
    public function showPlayer( string $itemSlug ) { return parent::showPlayer( $itemSlug ); }

    /**
     * @Route("maitre/verset/{itemSlug}", name="master.verse.show")
     */
    public function showMaster( string $itemSlug, Request $request ) { return parent::showMaster( $itemSlug, $request ); }
}
