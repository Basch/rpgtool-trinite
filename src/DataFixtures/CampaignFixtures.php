<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\CampaignData;
use App\Entity\Campaign;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CampaignFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        foreach( CampaignData::$DATA as $data ){

            /** @var User $master */
            $master = $this->getReference( 'user-'.$data['master_id'] );

            $campaign = new Campaign();
            $campaign
                ->setName( $data['name'] )
                ->setMaster( $master );

            $manager->persist( $campaign );


            $this->addReference('campaign-'.$data['id'], $campaign);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
