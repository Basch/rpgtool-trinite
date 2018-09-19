<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use App\Entity\Zodiac;
use Symfony\Component\Routing\Annotation\Route;

class CharacterSheetController extends MainController
{

    /**
     * @Route("/feuille-de-personnage", name="character-sheet")
     */
    public function main() {
        if( $error = $this->access->isConnected() ) return $this->doRedirect( $error );

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
        if( $error = $this->access->isMaster() ) return $this->doRedirect( $error );

        return $this->render('pages/character_sheet/list.html.twig', [
            'campaign' => $this->userData->getCampaign(),
        ]);

    }


    /**
     * @Route("/feuille-de-personnage/{characterSheet}", name="character-sheet.show")
     */
    public function show( PlayerCharacter $characterSheet )
    {
        $zodiacs = $this->getDoctrine()->getRepository( Zodiac::class )->findAll();

        return $this->render( 'pages/character_sheet/show.html.twig', [
            'characterSheet' => $characterSheet,
            'zodiacs' => $zodiacs,
        ] );
    }
}
