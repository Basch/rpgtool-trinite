<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CampaignController extends Controller
{


    /**
     * @Route("campaign/{campaignSlug}", name="main.campaign.index")
     * @ParamConverter("campaign", options={"mapping"={"campaignSlug"="slug"}})
     */
    public function main( Campaign $campaign ) {

        /** @var User $user */
        $user = $this->getUser();

        if( $campaign->getMaster()->getId() === $user->getId() ){
            return $this->master( $campaign );
        }

        return $this->player( $campaign );
    }


    /**
     * @Route("campaign/master/{campaignSlug}", name="master.campaign.index")
     * @ParamConverter("campaign", options={"mapping"={"campaignSlug"="slug"}})
     */
    public function master( Campaign $campaign )
    {
        /** @var User $user */
        $user = $this->getUser();

        if( $campaign->getMaster()->getId() !== $user->getId() ){
            $this->addFlash(
                'warning',
                'Vous ne maitrisez pas cette campagne : "'.$campaign->getName().'"'
            );
            return $this->redirectToRoute('home');
        }
        return $this->render('pages/campaign/master.html.twig', [
            'campaign' => $campaign,
        ]);
    }

    /**
     * @Route("campaign/player/{campaignSlug}", name="player.campaign.index")
     * @ParamConverter("campaign", options={"mapping"={"campaignSlug"="slug"}})
     */
    public function player( Campaign $campaign )
    {
        /** @var User $user */
        $user = $this->getUser();


        return $this->render( 'pages/campaign/player.html.twig', [
            'campaign' => $campaign,
        ] );

    }
}
