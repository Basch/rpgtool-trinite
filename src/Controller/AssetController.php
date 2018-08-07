<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends MainController
{

    /**
     * @Route("/asset", name="asset")
     */
    public function main() {
        if( $error = $this->control() ) { return $error; }


    }

    /**
     * @Route("/asset/list", name="asset.list")
     */
    public function list()
    {
        if( $error = $this->control() ) { return $error; }



        return $this->render('pages/asset/list.html.twig', [
            'assets' => $this->sideMenu->getCampaign(),
        ]);

    }


    /**
     * @Route("/character/sheet/{characterSheet}", name="character.sheet.show")
     */
    public function show( PlayerCharacter $characterSheet )
    {
        return $this->render( 'pages/character_sheet/show.html.twig', [
            'characterSheet' => $characterSheet,
        ] );
    }
}
