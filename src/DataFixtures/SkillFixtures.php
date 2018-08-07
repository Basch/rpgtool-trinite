<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\SkillData;
use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{


    public function load( ObjectManager $manager )
    {
        foreach ( SkillData::$DATA as $data ) {
            $skill = new Skill();

            /** @var Zodiac $zodiac */
            $zodiac = $this->getReference('zodiac-'. $data['zodiac'] );

            $skill
                ->setName( $data['name'] )
                ->setDomainRelated( $data['domain'] )
                ->setOpen( $data['open'] )
                ->setZodiac( $zodiac );

            $manager->persist( $skill );

            $this->addReference('skill-'.$data['id'], $skill);
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
