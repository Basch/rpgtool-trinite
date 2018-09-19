<?php

namespace App\DataFixtures;

use App\Entity\PlayerCharacter;
use App\Entity\CharacterSkill;
use App\Entity\CharacterZodiac;
use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterSkillFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        /** @var Skill $skill */
        $skills = $manager->getRepository( Skill::class )->findAll();

        foreach( $characters as $character ) foreach( $skills as $skill ){

            $level = rand( -3, 4);
            if( $level < 0 ) $level = 0;

            $characterSkill = new CharacterSkill();
            $characterSkill
                ->setLevel( $level )
                ->setSkill( $skill )
                ->setCharacter( $character );

            $manager->persist( $characterSkill );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterFixtures::class,
            SkillFixtures::class,
        );
    }
}
