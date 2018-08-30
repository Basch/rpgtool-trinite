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
        /** @var FiltrableItemInterface $item */
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

        /** @var FiltrableItemInterface $class */ // TODO : Voir pour type en static
        $class = $this->getClass();
        return $this->render( $this->getTemplate( 'list.player' ), [
            'items' => $items,
            'userCreatable' => $class::USER_CREATABLE,
            'route' => $this->getClassNameToLower(),
        ]);
    }

    public function listMaster()
    {
        if( $error = $this->controlMaster() ) { return $error; }

        /** @var FiltrableItemInterface $class */ // TODO : Voir pour type en static
        $class = $this->getClass();

        if( $class::CAMPAIGN_RELATED ) {
            $items = $this->getDoctrine()->getRepository( $this->getClass() )->findBy( [ 'campaign' => $this->userData->getCampaign() ] );
        }
        else {
            $items = $this->getDoctrine()->getRepository( $this->getClass() )->findBy( [ 'creator' => $this->getUser() ] );
        }

        return $this->render( $this->getTemplate( 'list.master' ), [
            'items' => $items,
            'route' => $this->getClassNameToLower(),
        ]);
    }

    public function show( string $itemSlug, Request $request )
    {
        if( $error = $this->control() ) { return $error; }

        $item = $this->getItem( $itemSlug );

        if( !$item ) {
            $this->addFlash(
                'warning',
                'Cet objet est inexistant.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        if( $this->userData->isMaster() /*|| $item->getWriter() === $this->userData->getCharacter()*/ ){ // TODO: checker si l'item est de la bonne campagne et checker si le joueur est le createur de l'item
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

        if( !$item ) {
            $this->addFlash(
                'warning',
                'Cet objet est inexistant.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        if( !$this->filter->viewItem( $item ) && $item->getWriter() !== $this->userData->getCharacter() ) {
            $this->addFlash(
                'warning',
                'Votre personnage ne peut pas voir cet objet.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        return $this->render( $this->getTemplate( 'show.player' ), [
            'item' => $item,
            'route' => $this->getClassNameToLower(),
        ]);

    }

    public function addItem( Request $request, $item = null ) {

        $class = $this->getClass();

        if( $this->get( ClassParserService::class )->getClass( $item ) != $class ) {
            /** @var FiltrableItemInterface $item */
            $item = new $class();
        }

        if( !$this->userData->isMaster() && !$item::USER_CREATABLE ){
            $this->addFlash(
                'warning',
                'Vous n\'avez pas les droits suffisant pour créer un objet de ce type.'
            );
            return $this->redirectToRoute('home');
        }

        $item->setCreator( $this->getUser() );
        if( $this->userData->isPlayer() ) {
            $item->setWriter( $this->userData->getCharacter() );
        }

        return $this->formItem( $item, $request );
    }

    public function editItem( string $itemSlug, Request $request )
    {

        $item = $this->getItem( $itemSlug );

        if( !$item ) {
            $this->addFlash(
                'warning',
                'Cet objet est inexistant.'
            );
            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }

        if( !$this->userData->isMaster() && (! $item->getWriter() || $item->getWriter()->getId() != $this->userData->getCharacter()->getId() ) ){
            $this->addFlash(
                'warning',
                'Vous n\'avez pas les droits suffisant pour créer un objet de ce type.'
            );
            return $this->redirectToRoute('home');
        }
        return $this->formItem( $item, $request );
    }

    protected function formItem( FiltrableItemInterface $item, Request $request ) {

        $form = $this->createForm( $this->getEditForm(), $item );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {

            $em = $this->getDoctrine()->getManager();

            $data = $request->request->get( $this->getClassNameToLower() );

            if( $item::CAMPAIGN_RELATED ) {
                $item->setCampaign( $this->userData->getCampaign() );
            }

            $em->persist( $item );
            $em->flush();

            $this->filter->updateFilter( $item );
            $this->filter->updateOwners( $item, $data['owners'] ?? [] );
            $this->filter->updateViewers( $item, $data['viewers'] ?? [] );

            $em->persist( $item );
            $em->flush();

            $this->addFlash(
                'success',
                'L\'objet a été correctement ajouté/modifié.'
            );

            return $this->redirectToRoute($this->getClassNameToLower().'.show', [
                'itemSlug' => $item->getSlug()
            ]);
        }

        return $this->render( $this->getTemplate( 'show.master' ), [
            'item' => $item,
            'form' => $form->createView(),
        ]);

    }

}
