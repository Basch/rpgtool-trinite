<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\FireBladeData;
use App\Entity\FireBlade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FireBladeFixtures extends Fixture
{



    public function load( ObjectManager $manager )
    {
        foreach( FireBladeData::$DATA as $data ){
            $fireBlade = new FireBlade();
            $fireBlade
              ->setName( $data['name'] );
            $manager->persist( $fireBlade );
            $manager->flush();

            $this->addReference('fireBlade-'.$data['id'], $fireBlade);
        }


    }
}
