<?php

namespace App\DataFixtures;

use App\Entity\CharacterSheet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterSheetFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var User[] $users */
        $users = $manager->getRepository( User::class )->findAll();

        foreach( $users as $user ){

            $characterSheet = new CharacterSheet();
            $user->addCharacterSheet( $characterSheet );

            $manager->persist( $user );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
