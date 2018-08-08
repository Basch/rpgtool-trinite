<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\AuraData;
use App\Entity\Aura;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuraFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        foreach( AuraData::$DATA as $data ){
            $aura = new Aura();

            /** @var Zodiac $zodiac */
            $zodiac = $this->getReference('zodiac-'.$data['zodiac_id']);

            $aura
                ->setDescription( $data['description'] )
                ->setBreath($data['breath'])
                ->setSign( $zodiac );
            $manager->persist( $aura );
            $manager->flush();

            $this->addReference('aura-'.$data['id'], $aura);
        }


    }

    public function getDependencies()
    {
        return array(
            ZodiacFixtures::class,
        );
    }

}
