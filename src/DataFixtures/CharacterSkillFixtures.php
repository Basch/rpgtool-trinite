<?php

namespace App\DataFixtures;

use App\Entity\CharacterSheet;
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
        /** @var CharacterSheet[] $characterSheets */
        $characterSheets = $manager->getRepository( CharacterSheet::class )->findAll();

        /** @var Skill $skill */
        $skills = $manager->getRepository( Skill::class )->findAll();

        foreach( $characterSheets as $characterSheet ) foreach( $skills as $skill ){

            $characterSkill = new CharacterSkill();
            $characterSkill
                ->setLevel( 0 )
                ->setSkill( $skill )
                ->setCharacterSheet( $characterSheet );

            $manager->persist( $characterSkill );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterSheetFixtures::class,
            SkillFixtures::class,
        );
    }
}
