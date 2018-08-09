<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\CharacterData;
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

        foreach ( CharacterData::$DATA as $data ) {

            /** @var User $user */
            $user = $this->getReference( 'user-' . $data['user_id'] );

            /** @var Campaign $campaign */
            $campaign = $this->getReference( 'campaign-' . $data['campaign_id'] );

            $character = new PlayerCharacter();
            $character
                ->setName( $data['name'] )
                ->setUser( $user )
                ->setCampaign( $campaign );


            $manager->persist( $character );

            $this->setReference( 'character-'.$data['id'], $character );
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
