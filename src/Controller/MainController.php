<?php

namespace App\Controller;

use App\Service\SideMenuService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class MainController extends Controller
{
    protected $sideMenu;

    public function __construct( SideMenuService $sideMenu )
    {
        $this->sideMenu = $sideMenu;
    }

    protected function controlPlayer() {

        if( !$this->sideMenu->isPlayer() ){
            $this->addFlash(
                'warning',
                'Vous devez être joueur pour acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }

    protected function controlMaster() {

        if( !$this->sideMenu->isMaster() ){
            $this->addFlash(
                'warning',
                'Vous devez être maitre de jeu pour acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }

    protected function control() {
        if( !$this->sideMenu->isMaster() && !$this->sideMenu->isPlayer() ){
            $this->addFlash(
                'warning',
                'Vous devez choisir une campagne ou un personnage pour pouvoir acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }
}
