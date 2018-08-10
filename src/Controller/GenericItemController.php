<?php

namespace App\Controller;
;
use App\Form\AssetType;
use App\Service\ClassParserService;
use Symfony\Component\HttpFoundation\Request;

abstract class GenericItemController extends MainController
{
    abstract protected function getEditForm() :string;

    abstract protected function getClass() :string;

    protected function getClassName() :string
    {
        return $this->get( ClassParserService::class )->parseClass( $this->getClass() );
    }

    protected function getClassNameToLower() :string
    {
        return strtolower($this->getClassName());
    }

    protected function getTemplate( string $template )
    {

    }

    protected function getItem( string $itemSlug ){
        return $this->getDoctrine()->getRepository( $this->getClass() )->findOneBy( ['slug' => $itemSlug] );
    }

    public function main() {
        if( $error = $this->control() ) { return $error; }

        return $this->list();
    }

    public function list()
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){
            return $this->listMaster();
        }
        else {
            return $this->listPlayer();
        }
    }

    public function listPlayer()
    {
        if( $error = $this->controlPlayer() ) { return $error; }

        $items = $this->filter->getVisibleItems( $this->getClass() );

        return $this->render('pages/'.$this->getClassNameToLower().'/list.player.html.twig', [
            'items' => $items,
        ]);
    }


    public function listMaster()
    {
        if( $error = $this->controlMaster() ) { return $error; }

        $items = $this->getDoctrine()->getRepository( $this->getClass() )->findAll();

        return $this->render('pages/'.$this->getClassNameToLower().'/list.master.html.twig', [
            'items' => $items,
        ]);
    }

    public function show( string $itemSlug, Request $request )
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){
            return $this->showMaster( $itemSlug, $request );
        }
        else {
            return $this->showPlayer( $itemSlug );
        }
    }

    public function showPlayer( string $itemSlug )
    {
        $item = $this->getItem( $itemSlug );

        if( $error = $this->controlPlayer() ) { return $error; }

        if( !$this->filter->viewItem( $item ) ) {
            $this->addFlash(
                'warning',
                'Votre personnage ne peut pas voir cet objet.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        return $this->render('pages/'.$this->getClassNameToLower().'/show.player.html.twig', [
            'item' => $item,
        ]);

    }


    public function showMaster( string $itemSlug, Request $request )
    {
        $item = $this->getItem( $itemSlug );

        if( $error = $this->controlMaster() ) { return $error; }

        $form = $this->createForm( $this->getEditForm(), $item );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            $data = $request->request->get( $this->getClassNameToLower() );

            $this->filter->updateOwners( $item, $data['owners'] ?? [] );
            $this->filter->updateViewers( $item, $data['viewers'] ?? [] );

            $em->persist( $item );
            $em->flush();

            return $this->redirectToRoute('master.'.$this->getClassNameToLower().'.show', [
                $this->getClassNameToLower().'Slug' => $item->getSlug()
            ]);
        }

        return $this->render('pages/'.$this->getClassNameToLower().'/show.master.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }
}
