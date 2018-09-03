<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\MainData;
use App\Entity\Campaign;
use App\Entity\Location;
use App\Entity\NonPlayerCharacter;
use App\Entity\PlayerCharacter;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var Campaign[] $campaigns */
        $campaigns = $manager->getRepository( Campaign::class )->findAll();

        foreach( $campaigns as $campaign ) for( $i = 1 ; $i <= MainData::NBR_MAP_PER_CAMPAIGN ; $i++ ) {

            $name = "Location-$i";
            $location = new Location();
            $location
                ->setName( $name )
                ->setLink( '' )
                ->setCampaign( $campaign )
                ->setCreator( $campaign->getMaster() );

            $manager->persist( $location );
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
