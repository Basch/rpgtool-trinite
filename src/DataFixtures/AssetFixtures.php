<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\AssetData;
use App\DataFixtures\Data\UserData;
use App\Entity\Asset;
use App\Entity\FireBlade;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AssetFixtures extends Fixture implements DependentFixtureInterface
{


    public function load( ObjectManager $manager )
    {
        $users_data = UserData::$DATA;
        foreach ( AssetData::$DATA as $data ) foreach ( $users_data as $user_data ) {
            $asset = new Asset();

            /** @var FireBlade $fireBlade */
            $fireBlade = $this->getReference('fireBlade-'. $data['fire_blade_id'] );

            /** @var User $user */
            $user = $this->getReference('user-'. $user_data['id'] );

            $asset
                ->setName( $data['name'] )
                ->setCreator( $user )
                ->setDescription( $data['description'] )
                ->setColor( $data['color'] )
                ->setFireBlade( $fireBlade );

            $manager->persist( $asset );

            $this->addReference('asset-'. $user_data['id'] .'-'.$data['id'], $asset);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            FireBladeFixtures::class,
        );
    }




}
