<?php

namespace App\DataFixtures;

use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Entity\User;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterFixtures extends Fixture implements DependentFixtureInterface
{
    private $z_index = 1;

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
                ->setCampaign( $campaign )
                ->setArchetype( $this->getZodiac() )
                ->addAscendant( $this->getZodiac() )
                ->addAscendant( $this->getZodiac() )
                ->addDescendant( $this->getZodiac() )
                ->addDescendant( $this->getZodiac() )
                ->addDescendant( $this->getZodiac() )
            ;


            $manager->persist( $character );
        }

        $manager->flush();
    }

    public function getZodiac():Zodiac {
        $this->z_index += 5;
        if( $this->z_index > 12 ) $this->z_index -= 12;

        return $this->getReference('zodiac-'.$this->z_index );
    }

    public function getDependencies()
    {
        return array(
            ZodiacFixtures::class,
            UserFixtures::class,
            CampaignFixtures::class,
        );
    }
}
