<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\CampaignData;
use App\DataFixtures\Data\CharacterData;
use App\DataFixtures\Data\MainData;
use App\DataFixtures\Data\UserData;
use App\Entity\Asset;
use App\Entity\Aura;
use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var User[] $users */
        $users = $manager->getRepository( User::class )->findAll();

        /** @var Campaign[] $campaigns */
        $campaigns = $manager->getRepository( Campaign::class )->findAll();

        foreach ( $users as $user ) foreach( $campaigns as $campaign ) {

            if( $user === $campaign->getMaster() ) continue;

            $name = substr( $user->getUsername(),0,3 ) . substr( $campaign->getMaster()->getUsername(), 0,3 ) . substr($campaign->getName(),-1);

            $character = new PlayerCharacter();
            $character
                ->setName( $name )
                ->setUser( $user )
                ->setCampaign( $campaign );


            $manager->persist( $character );
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AssetFixtures::class,
            UserFixtures::class,
            CampaignFixtures::class,
        );
    }
}
