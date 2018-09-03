<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\MainData;
use App\Entity\Campaign;
use App\Entity\NonPlayerCharacter;
use App\Entity\PlayerCharacter;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NPCFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var Campaign[] $campaigns */
        $campaigns = $manager->getRepository( Campaign::class )->findAll();

        foreach( $campaigns as $campaign ) for( $i = 1 ; $i <= MainData::NBR_NPC_PER_CAMPAIGN ; $i++ ) {

            $name = "PNJ-$i";
            $character = new NonPlayerCharacter();
            $character
                ->setName( $name )
                ->setDescription( 'pnj de la campagne : '.$campaign->getName() )
                ->setCampaign( $campaign )
                ->setCreator( $campaign->getMaster() );

            $manager->persist( $character );
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CampaignFixtures::class,
        );
    }
}
