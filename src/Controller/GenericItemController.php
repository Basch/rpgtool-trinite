<?php

namespace App\Controller;

use App\Model\FiltrableItemInterface;
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

    protected function getTemplate( string $template ): string
    {
        $test = 'pages/'.$this->getClassNameToLower().'/' . $template . '.html.twig';
        if( $this->engine->exists( $test ) ){
            return $test;
        }
        return 'pages/default/' . $template . '.html.twig';
    }

    protected function getItem( string $itemSlug ): ?FiltrableItemInterface {
        /** @var FiltrableItemInterface|null $item */
        $item = $this->getDoctrine()->getRepository( $this->getClass() )->findOneBy( ['slug' => $itemSlug] );
        return $item;
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

        return $this->render( $this->getTemplate( 'list.player' ), [
            'items' => $items,
        ]);
    }

    public function listMaster()
    {
        if( $error = $this->controlMaster() ) { return $error; }

        $items = $this->getDoctrine()->getRepository( $this->getClass() )->findBy( [ 'creator' => $this->getUser() ] );

        return $this->render($this->getTemplate( 'list.master' ), [
            'items' => $items,
        ]);
    }

    public function show( string $itemSlug, Request $request )
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isMaster() ){ // TODO: checker si l'item est de la bonne campagne et checker si le joueur est le createur de l'item
            return $this->editItem( $itemSlug, $request );
        }
        else {
            return $this->showItem( $itemSlug );
        }
    }

    public function showItem( string $itemSlug )
    {
        $item = $this->getItem( $itemSlug );

        if( $error = $this->controlPlayer() ) { return $error; }

        if( !$item || !$this->filter->viewItem( $item ) ) {
            $this->addFlash(
                'warning',
                'Votre personnage ne peut pas voir cet objet.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        return $this->render($this->getTemplate( 'show.player' ), [
            'item' => $item,
        ]);

    }

    public function addItem( Request $request ) {

        $class = $this->getClass();
        /** @var FiltrableItemInterface $item */
        $item = new $class();
        $item->setCreator( $this->getUser() );

        return $this->formItem( $item, $request );
    }

    public function editItem( string $itemSlug, Request $request )
    {
        $item = $this->getItem( $itemSlug );

        return $this->formItem( $item, $request );
    }

    protected function formItem( FiltrableItemInterface $item, Request $request ) {

        if( $error = $this->controlMaster() ) { return $error; }

        $form = $this->createForm( $this->getEditForm(), $item );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            $data = $request->request->get( $this->getClassNameToLower() );

            $this->filter->updateFilter( $item );
            $this->filter->updateOwners( $item, $data['owners'] ?? [] );
            $this->filter->updateViewers( $item, $data['viewers'] ?? [] );

            $em->persist( $item );
            $em->flush();

            return $this->redirectToRoute('master.'.$this->getClassNameToLower().'.show', [
                'itemSlug' => $item->getSlug()
            ]);
        }

        return $this->render($this->getTemplate( 'show.master' ), [
            'item' => $item,
            'form' => $form->createView(),
        ]);

    }


}
