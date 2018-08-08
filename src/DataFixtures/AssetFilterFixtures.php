<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\AssetFilter;
use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AssetFilterFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var Asset[] $assets */
        $assets = $manager->getRepository( Asset::class )->findAll();

        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        foreach( $assets as $asset ) foreach( $characters as $character ){

            $assetFilter = new AssetFilter();
            $assetFilter
                ->setCharacter( $character )
                ->setAsset( $asset );



            $manager->persist( $assetFilter );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterFixtures::class,
            SkillFixtures::class,
            AssetFixtures::class,
        );
    }
}
