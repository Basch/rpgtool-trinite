<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\AuraData;
use App\DataFixtures\Data\UserData;
use App\Entity\Aura;
use App\Entity\User;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuraFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        $users_data = UserData::$DATA;
        foreach( AuraData::$DATA as $data ) foreach ( $users_data as $user_data ) {
            $aura = new Aura();

            /** @var Zodiac $zodiac */
            $zodiac = $this->getReference('zodiac-'.$data['zodiac_id']);

            /** @var User $user */
            $user = $this->getReference('user-'. $user_data['id'] );

            $aura
                ->setDescription( $data['description'] )
                ->setCreator( $user )
                ->setBreath( $data['breath'] )
                ->setSign( $zodiac );
            $manager->persist( $aura );
            $manager->flush();

            $this->addReference('aura-'. $user_data['id'] .'-'.$data['id'], $aura);
        }


    }

    public function getDependencies()
    {
        return array(
            ZodiacFixtures::class,
        );
    }

}
