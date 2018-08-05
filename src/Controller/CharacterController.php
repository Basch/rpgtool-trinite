<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CharacterController extends Controller
{
    /**
     * @Route("/player/character/{characterSlug}", name="player.character.index")
     * @ParamConverter("character", options={"mapping"={"characterSlug"="slug"}})
     */
    public function player( PlayerCharacter $character )
    {
        return $this->render('pages/character/player.html.twig', [
            'character' => $character,
        ]);
    }

    /**
     * @Route("/master/character/{characterSlug}", name="master.character.index")
     * @ParamConverter("character", options={"mapping"={"characterSlug"="slug"}})
     */
    public function master( PlayerCharacter $character )
    {
        return $this->render('pages/character/master.html.twig', [
            'character' => $character,
        ]);
    }
}
