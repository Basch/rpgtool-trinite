<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function campaigns()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('pages/main/campaigns.html.twig', [
            'mastered_campaigns' => $user->getMasteredCampaigns(),
            'played_campaigns' => $user->getPlayedCampaigns(),
        ]);
    }

    /**
     * @Route("/characters", name="user.characters")
     */
    public function characters()
    {
        /** @var User $user */
        $user = $this->getUser();


        return $this->render('pages/main/characters.html.twig', [
            'characters' => $user->getCharacters(),
        ]);
    }
}
