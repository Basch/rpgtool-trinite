<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\ReportType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends GenericItemController
{

    protected function getEditForm(): string
    {
        return ReportType::class;
    }

    protected function getClass(): string
    {
        return Report::class;
    }

    /**
     * @Route("/rapport", name="report")
     */
    public function main() { return parent::main(); }

    /**
     * @Route("/rapport/liste", name="report.list")
     */
    public function list() { return parent::list(); }

    /**
     * @Route("joueur/rapport/liste", name="player.report.list")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/rapport/liste", name="master.report.list")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/rapport/{itemSlug}", name="report.show")
     */
    public function show( string $itemSlug, Request $request ) { return parent::show( $itemSlug, $request ); }

    /**
     * @Route("joueur/rapport/nouveau", name="report.new")
     */
    public function addItem( Request $request ) { return parent::addItem( $request ); }

    /**
     * @Route("joueur/rapport/{itemSlug}", name="player.report.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("maitre/rapport/{itemSlug}", name="master.report.show")
     */
    public function editItem( string $itemSlug, Request $request ) { return parent::editItem( $itemSlug, $request ); }

}
