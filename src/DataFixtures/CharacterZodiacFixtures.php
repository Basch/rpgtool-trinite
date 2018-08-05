<?php

namespace App\DataFixtures;

use App\Entity\PlayerCharacter;
use App\Entity\CharacterZodiac;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterZodiacFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        /** @var Zodiac $zodiac */
        $zodiacs = $manager->getRepository( Zodiac::class )->findAll();

        foreach ( $characters as $character ) foreach ( $zodiacs as $zodiac ) {

            $characterZodiac = new CharacterZodiac();
            $characterZodiac
                ->setLevel( 1 )
                ->setZodiac( $zodiac )
                ->setCharacter( $character );

            $manager->persist( $characterZodiac );


        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterFixtures::class,
            ZodiacFixtures::class,
        );
    }
}
