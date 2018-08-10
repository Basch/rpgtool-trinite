<?php

namespace App\DataFixtures;

use App\Entity\FilterCharacterAura;
use App\Entity\FilterCharacterVerse;
use App\Entity\PlayerCharacter;
use App\Entity\Verse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FilterCharacterVerseFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        /** @var Verse[] $verses */
        $verses = $manager->getRepository( Verse::class )->findAll();

        foreach( $characters as $character ) foreach( $verses as $verse ){

            $characterSkill = new FilterCharacterVerse();
            $characterSkill
                ->setCharacter( $character )
                ->setVerse( $verse )
                ->setOwned( false )
                ->setVisible( true );

            $manager->persist( $characterSkill );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterFixtures::class,
            VerseFixtures::class,
        );
    }
}
