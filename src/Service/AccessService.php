<?php

namespace App\Service;


use App\Model\FiltrableItemInterface;
use App\Object\FlashResponse;
use App\Object\RedirectResponse;

class AccessService
{

    protected $userData;
    protected $filter;
    protected $engine;

    public function __construct( UserDataService $userData, FilterService $filter )
    {
        $this->userData = $userData;
        $this->filter = $filter;
    }

    public function isConnected(): ?RedirectResponse {

        if( !$this->userData->isMaster() && !$this->userData->isPlayer() ){
            $flash = new FlashResponse(
                'warning',
                'Vous devez choisir une campagne ou un personnage pour pouvoir acceder à cette page.'
            );
            return new RedirectResponse( 'home', [], $flash );
        }
        return null;
    }

    public function isMaster(): ?RedirectResponse {

        if( !$this->userData->isMaster() ){
            $flash = new FlashResponse(
                'warning',
                'Vous devez être maitre de jeu pour acceder à cette page.'
            );
            return new RedirectResponse('home', [], $flash );
        }
        return null;
    }

    public function isPlayer(): ?RedirectResponse {

        if( !$this->userData->isPlayer() ){
            $flash = new FlashResponse(
                'warning',
                'Vous devez être joueur pour acceder à cette page.'
            );
            return new RedirectResponse('home', [], $flash );
        }
        return null;
    }

    public function checkItem( FiltrableItemInterface $item ): ?RedirectResponse {

        if( !$item ) {
            $flash = new FlashResponse(
                'warning',
                'Cet objet est inexistant.'
            );
            return new RedirectResponse( 'home', [], $flash ); // TODO Personnaliser les routes, voir avec un sprint()
            //            return $this->redirectToRoute($this->getClassNameToLower().'.list');
        }
        return null;
    }

    public function showItem( FiltrableItemInterface $item ): ?RedirectResponse {

        if( $error = $this->checkItem( $item ) ) return $error;

        if( !$this->filter->viewItem( $item ) && $item->getWriter() !== $this->userData->getCharacter() && !$this->userData->isMaster() ) {
            $flash = new FlashResponse(
                'warning',
                'Votre personnage ne peut pas voir cet objet.'
            );
            return new RedirectResponse( 'home', [], $flash );
        }
        return null;
    }

    public function addItem( FiltrableItemInterface $item ): ?RedirectResponse {

        if( !$this->userData->isMaster() && !$item::USER_CREATABLE ){
            $flash = new FlashResponse(
                'warning',
                'Vous n\'avez pas les droits suffisant pour créer un objet de ce type.'
            );
            return new RedirectResponse( 'home', [], $flash );
        }
        return null;
    }

    public function editItem( FiltrableItemInterface $item ): ?RedirectResponse {

        if( $error = $this->checkItem( $item ) ) return $error;

        if( !$this->userData->isMaster() && (! $item->getWriter() || $item->getWriter()->getId() != $this->userData->getCharacter()->getId() ) ){
            $flash = new FlashResponse(
                'warning',
                'Vous n\'avez pas les droits suffisant pour créer un objet de ce type.'
            );
            return new RedirectResponse( 'home', [], $flash );
        }
        return null;
    }

    public function addComment( FiltrableItemInterface $item ): ?RedirectResponse {

        if( $error = $this->showItem( $item ) ) return $error;

        if( !$item::COMMENTABLE ){
            $flash = new FlashResponse(
                'warning',
                'Cet objet ne peut être commenté.'
            );
            return new RedirectResponse( 'home', [], $flash );
        }
        return null;
    }
}