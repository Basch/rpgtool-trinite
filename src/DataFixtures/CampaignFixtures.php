<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\CampaignData;
use App\DataFixtures\Data\MainData;
use App\DataFixtures\Data\UserData;
use App\Entity\Campaign;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CampaignFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        foreach( UserData::$DATA as $d_user ){

            /** @var User $master */
            $master = $this->getReference( 'user-'.$d_user['id'] );

            for( $i = 1 ; $i <= MainData::NBR_CAMPAIGN_PER_USER ; $i++ ) {

                $campaign = new Campaign();
                $campaign
                    ->setName( 'Campagne de '.$master->getUsername().' '.$i )
                    ->setMaster( $master );

                $manager->persist( $campaign );


                $this->addReference( 'campaign-' . $d_user['id'] .'-'. $i, $campaign );
            }
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
