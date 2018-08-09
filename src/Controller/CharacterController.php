<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CharacterController extends MainController
{


    /**
     * @Route("joueur/personnage/{characterSlug}", name="player.character.index")
     * @ParamConverter("character", options={"mapping"={"characterSlug"="slug"}})
     */
    public function player( PlayerCharacter $character )
    {
        $this->userData->setCharacter( $character );
        return $this->render('pages/character/player.html.twig', [
            'character' => $character,
        ]);
    }

    /**
     * @Route("meneur/personnage/{characterSlug}", name="master.character.index")
     * @ParamConverter("character", options={"mapping"={"characterSlug"="slug"}})
     */
    public function master( PlayerCharacter $character )
    {
        return $this->render('pages/character/master.html.twig', [
            'character' => $character,
        ]);
    }
}
