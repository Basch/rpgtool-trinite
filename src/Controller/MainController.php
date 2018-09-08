<?php

namespace App\Controller;

use App\Object\RedirectResponse;
use App\Service\AccessService;
use App\Service\FilterService;
use App\Service\UserDataService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Templating\EngineInterface;

abstract class MainController extends Controller
{
    protected $userData;
    protected $filter;
    protected $engine;
    protected $access;

    public function __construct( UserDataService $userData, FilterService $filter, AccessService $access, EngineInterface $engine )
    {
        $this->userData = $userData;
        $this->filter = $filter;
        $this->access = $access;
        $this->engine = $engine;
        srand( 1 );
    }

    protected function doRedirect( RedirectResponse $redirectResponse ){

        if( $flash = $redirectResponse->getFlash() ){
            $this->addFlash(
                $flash->getType(),
                $flash->getMessage()
            );
        }

        return $this->redirectToRoute(
            $redirectResponse->getRoute(),
            $redirectResponse->getArguments()
        );
    }

}
