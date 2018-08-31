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

        if( $error = $this->access->isConnected() ) return $this->doRedirect( $error );
        return $this->list();
    }

    public function list()
    {
        if( $error = $this->access->isConnected() ) return $this->doRedirect( $error );

        if( $this->userData->isMaster() ){
            return $this->listMaster();
        }
        else {
            return $this->listPlayer();
        }
    }

    public function listPlayer()
    {
        if( $error = $this->access->isPlayer() ) return $this->doRedirect( $error );

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
        if( $error = $this->access->isMaster() ) return $this->doRedirect( $error );

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

    public function item( string $itemSlug, Request $request )
    {
        $item = $this->getItem( $itemSlug );

        if( $error = $this->access->isConnected() ) return $this->doRedirect( $error );
        if( $error = $this->access->checkItem( $item ) ) return $this->doRedirect( $error );

        if( $this->userData->isMaster() && !$item->getWriter() ){ // TODO: checker si l'item est de la bonne campagne et checker si le joueur est le createur de l'item
            return $this->editItem( $itemSlug, $request );
        }
        else {
            return $this->showItem( $itemSlug );
        }
    }

    public function showItem( string $itemSlug )
    {
        $item = $this->getItem( $itemSlug );

        if( $error = $this->access->isConnected() ) return $this->doRedirect( $error );
        if( $error = $this->access->showItem( $item ) ) return $this->doRedirect( $error );

        return $this->render( $this->getTemplate( 'show.item' ), [
            'item' => $item,
            'route' => $this->getClassNameToLower(),
        ]);

    }

    public function newItem( Request $request, $item = null ) {

        $class = $this->getClass();

        if( $this->get( ClassParserService::class )->getClass( $item ) != $class ) {
            /** @var FiltrableItemInterface $item */
            $item = new $class();
        }

        if( $error = $this->access->addItem( $item ) ) return $this->doRedirect( $error );

        $item->setCreator( $this->getUser() );
        if( $this->userData->isPlayer() ) {
            $item->setWriter( $this->userData->getCharacter() );
        }

        return $this->formItem( $item, $request );
    }

    public function editItem( string $itemSlug, Request $request )
    {

        $item = $this->getItem( $itemSlug );
        if( $error = $this->access->editItem( $item ) ) return $this->doRedirect( $error );

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

        return $this->render( $this->getTemplate( 'form.item' ), [
            'item' => $item,
            'form' => $form->createView(),
        ]);

    }

}
