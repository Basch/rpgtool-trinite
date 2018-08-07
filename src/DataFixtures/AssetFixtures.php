<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\SkillData;
use App\Entity\Asset;
use App\Entity\FireBlade;
use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AssetFixtures extends Fixture implements DependentFixtureInterface
{


    public function load( ObjectManager $manager )
    {
        foreach ( AssetData::$DATA as $data ) {
            $asset = new Asset();

            /** @var FireBlade $fireBlade */
            $fireBlade = $this->getReference('fireBlage-'. $data['fire_blade_id'] );

            $asset
                ->setName( $data['name'] )
                ->setDescription( $data['description'] )
                ->setColor( $data['color'] )
                ->setFireBlade( $fireBlade );

            $manager->persist( $asset );

            $this->addReference('asset-'.$data['id'], $asset);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ZodiacFixtures::class,
        );
    }




}
