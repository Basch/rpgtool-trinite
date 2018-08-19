<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Aura;
use App\Entity\Report;
use App\Entity\User;
use App\Entity\Verse;
use App\Model\FiltrableItemInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends MainController
{

    /**
     * @Route("/demo", name="demo")
     */
    public function demo() {

        $this->userData->clear();

        /** @var User $user */
        $user = $this->getUser();

        return $this->render('demo.html.twig', [
            'mastered_campaigns' => $user->getMasteredCampaigns(),
            'played_campaigns' => $user->getPlayedCampaigns(),
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function main() {

        /** @var FiltrableItemInterface[] $classes */
        $classes = [ Asset::class, Aura::class, Verse::class, Report::class ];


        foreach( $classes as $class ){
            dump( $class . ' - ' . $class::USER_CREATABLE );
        }

        dump($this->engine->exists('pages/main/index.html.twig'));
        dump($this->engine->exists('pages/main/yolo.html.twig'));


        $this->userData->clear();

        /** @var User $user */
        $user = $this->getUser();

        return $this->render('pages/main/index.html.twig', [
            'mastered_campaigns' => $user->getMasteredCampaigns(),
            'played_campaigns' => $user->getPlayedCampaigns(),
        ]);
    }


}
