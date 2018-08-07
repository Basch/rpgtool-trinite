<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends MainController
{
    /**
     * @Route("/", name="home")
     */
    public function campaigns()
    {
        $this->sideMenu->clear();

        /** @var User $user */
        $user = $this->getUser();

        return $this->render('pages/main/index.html.twig', [
            'mastered_campaigns' => $user->getMasteredCampaigns(),
            'played_campaigns' => $user->getPlayedCampaigns(),
        ]);
    }


}
