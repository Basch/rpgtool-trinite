<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\MainData;
use App\Entity\Campaign;
use App\Entity\NonPlayerCharacter;
use App\Entity\NonPlayerCharacterSkill;
use App\Entity\PlayerCharacter;
use App\Entity\Skill;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NPCSkillFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {

        /** @var NonPlayerCharacter[] $characters */
        $characters = $manager->getRepository( NonPlayerCharacter::class )->findAll();

        /** @var Skill $skill */
        $skills = $manager->getRepository( Skill::class )->findAll();

        foreach( $characters as $character ) foreach( $skills as $skill ) {

            $characterSkill = new NonPlayerCharacterSkill();
            $characterSkill
                ->setLevel( 0 )
                ->setSkill( $skill )
                ->setNpc( $character );

            $manager->persist( $characterSkill );
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            NPCFixtures::class,
            SkillFixtures::class
        );
    }
}
