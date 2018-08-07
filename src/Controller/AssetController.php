<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends MainController
{

    /**
     * @Route("/atout", name="asset")
     */
    public function main() {
        if( $error = $this->control() ) { return $error; }

        return $this->list();
    }

    /**
     * @Route("/atout/liste", name="asset.list")
     */
    public function list()
    {
        if( $error = $this->control() ) { return $error; }

        if( $this->sideMenu->isMaster() ){
            $assets = $this->getDoctrine()->getRepository( Asset::class )->findAll();
        }
        else {
            $assets = $this->sideMenu->getCharacter()->getAssets();
        }

        return $this->render('pages/asset/list.html.twig', [
            'assets' => $assets,
        ]);
    }


    /**
     * @Route("/asset/{asset}", name="asset.show")
     */
    public function show( Asset $asset )
    {
        return $this->render( 'pages/asset/show.html.twig', [
            'asset' => $asset,
        ] );
    }
}
