<?php

namespace App\DataFixtures;

use App\Entity\Aura;
use App\Entity\FilterCharacterAura;
use App\Entity\PlayerCharacter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FilterCharacterAuraFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        /** @var Aura[] $auras */
        $auras = $manager->getRepository( Aura::class )->findAll();

        foreach( $characters as $character ) foreach( $auras as $aura ){

            $characterSkill = new FilterCharacterAura();
            $characterSkill
                ->setCharacter( $character )
                ->setAura( $aura )
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
            AssetFixtures::class,
        );
    }
}
