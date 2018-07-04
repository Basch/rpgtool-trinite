<?php

namespace App\DataFixtures;

use App\Entity\CharacterSheet;
use App\Entity\CharacterZodiac;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterZodiacFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var CharacterSheet[] $characterSheets */
        $characterSheets = $manager->getRepository( CharacterSheet::class )->findAll();

        /** @var Zodiac $zodiac */
        $zodiacs = $manager->getRepository( Zodiac::class )->findAll();

        foreach ( $characterSheets as $characterSheet ) foreach ( $zodiacs as $zodiac ) {

            $characterZodiac = new CharacterZodiac();
            $characterZodiac
                ->setLevel( 1 )
                ->setZodiac( $zodiac )
                ->setCharacterSheet( $characterSheet );

            $manager->persist( $characterZodiac );


        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterSheetFixtures::class,
            ZodiacFixtures::class,
        );
    }
}
