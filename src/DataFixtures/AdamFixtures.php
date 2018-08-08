<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\AdamData;
use App\Entity\Adam;
use App\Entity\Asset;
use App\Entity\FireBlade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdamFixtures extends Fixture
{


    public function load( ObjectManager $manager )
    {
        foreach ( AdamData::$DATA as $data ) {
            $adam = new Adam();

            $adam->setName( $data['name'] );
            $manager->persist( $adam );

            $this->addReference('adam-'.$data['id'], $adam);
        }

        $manager->flush();
    }





}
