<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;

class CharacterSheetController extends MainController
{

    /**
     * @Route("/feuille-de-personnage", name="character-sheet")
     */
    public function main() {
        if( $error = $this->control() ) { return $error; }

        if( $this->userData->isPlayer() ) {
            return $this->show( $this->userData->getCharacter() );
        }

        return $this->list();
    }

    /**
     * @Route("/feuille-de-personnage/liste", name="character-sheet.list")
     */
    public function list()
    {
        if( $error = $this->controlMaster() ) { return $error; }

        return $this->render('pages/character_sheet/list.html.twig', [
            'campaign' => $this->userData->getCampaign(),
        ]);

    }


    /**
     * @Route("/feuille-de-personnage/{characterSheet}", name="character-sheet.show")
     */
    public function show( PlayerCharacter $characterSheet )
    {
        return $this->render( 'pages/character_sheet/show.html.twig', [
            'characterSheet' => $characterSheet,
        ] );
    }
}
