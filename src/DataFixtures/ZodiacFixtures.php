<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\ZodiacData;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ZodiacFixtures extends Fixture
{



    public function load( ObjectManager $manager )
    {
        foreach( ZodiacData::$DATA as $data ){
            $zodiac = new Zodiac();
            $zodiac
              ->setName( $data['name'] );
            $manager->persist( $zodiac );
            $manager->flush();

            $this->addReference('zodiac-'.$data['id'], $zodiac);
        }


    }
}
