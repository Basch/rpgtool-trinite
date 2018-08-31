<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\Entities\ReportType;
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
     * @Route("joueur/rapport/liste", name="report.list.player")
     */
    public function listPlayer() { return parent::listPlayer(); }

    /**
     * @Route("meneur/rapport/liste", name="report.list.master")
     */
    public function listMaster() { return parent::listMaster(); }

    /**
     * @Route("/rapport/{itemSlug}", name="report.item")
     */
    public function item( string $itemSlug, Request $request ) { return parent::item( $itemSlug, $request ); }

    /**
     * @Route("nouveau/rapport", name="report.new")
     */
    public function newItem( Request $request, $item = null ) {

        return parent::newItem( $request );
    }

    /**
     * @Route("voir/rapport/{itemSlug}", name="report.show")
     */
    public function showItem( string $itemSlug ) { return parent::showItem( $itemSlug ); }

    /**
     * @Route("modifier/rapport/{itemSlug}", name="report.edit")
     */
    public function editItem( string $itemSlug, Request $request ) { return parent::editItem( $itemSlug, $request ); }

}
