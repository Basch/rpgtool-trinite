<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\FilterCharacterAsset;
use App\Entity\PlayerCharacter;
use App\Entity\CharacterSkill;
use App\Entity\CharacterZodiac;
use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FilterCharacterAssetFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        /** @var Asset[] $assets */
        $assets = $manager->getRepository( Asset::class )->findAll();

        foreach( $characters as $character ) foreach( $assets as $asset ){

            $characterSkill = new FilterCharacterAsset();
            $characterSkill
                ->setCharacter( $character )
                ->setAsset( $asset )
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
