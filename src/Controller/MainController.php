<?php

namespace App\Controller;

use App\Service\FilterService;
use App\Service\UserDataService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Templating\EngineInterface;

abstract class MainController extends Controller
{
    protected $userData;
    protected $filter;
    protected $engine;

    public function __construct( UserDataService $userData, FilterService $filter, EngineInterface $engine )
    {
        $this->userData = $userData;
        $this->filter = $filter;
        $this->engine = $engine;

    }

    protected function controlPlayer() {

        if( !$this->userData->isPlayer() ){
            $this->addFlash(
                'warning',
                'Vous devez être joueur pour acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }

    protected function controlMaster() {

        if( !$this->userData->isMaster() ){
            $this->addFlash(
                'warning',
                'Vous devez être maitre de jeu pour acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }

    protected function control() {
        if( !$this->userData->isMaster() && !$this->userData->isPlayer() ){
            $this->addFlash(
                'warning',
                'Vous devez choisir une campagne ou un personnage pour pouvoir acceder à cette page.'
            );
            return $this->redirectToRoute('home');
        }

        return null;
    }
}
