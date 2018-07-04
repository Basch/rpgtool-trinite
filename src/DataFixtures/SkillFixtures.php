<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{


    public function load( ObjectManager $manager )
    {
        foreach ( $this->data as $data ) {
            $skill = new Skill();

            /** @var Zodiac $zodiac */
            $zodiac = $this->getReference('zodiac-'. $data['zodiac'] );

            $skill
                ->setName( $data['name'] )
                ->setDomainRelated( $data['domain'] )
                ->setOpen( $data['open'] )
                ->setZodiac( $zodiac );

            $manager->persist( $skill );

            //$this->setReference()
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ZodiacFixtures::class,
        );
    }

    private $data = [
        /** GEMEAUX */
        [
            'id' => 1,
            'name' => 'Art',
            'domain' => true,
            'open' => true,
            'zodiac' => 1,
        ],
        [
            'id' => 2,
            'name' => 'Empathie',
            'domain' => false,
            'open' => true,
            'zodiac' => 1,
        ],
        [
            'id' => 3,
            'name' => 'Séduction',
            'domain' => false,
            'open' => true,
            'zodiac' => 1,
        ],
        /** VIERGE */
        [
            'id' => 4,
            'name' => 'Clairvoyance',
            'domain' => false,
            'open' => false,
            'zodiac' => 2,
        ],
        [
            'id' => 5,
            'name' => 'Emprise',
            'domain' => false,
            'open' => false,
            'zodiac' => 2,
        ],
        [
            'id' => 6,
            'name' => 'Méditation',
            'domain' => false,
            'open' => false,
            'zodiac' => 2,
        ],
        /** SAGITAIRE */
        [
            'id' => 7,
            'name' => 'Survie',
            'domain' => false,
            'open' => true,
            'zodiac' => 3,
        ],
        [
            'id' => 8,
            'name' => 'Tir',
            'domain' => false,
            'open' => true,
            'zodiac' => 3,
        ],
        [
            'id' => 9,
            'name' => 'Vigilance',
            'domain' => false,
            'open' => true,
            'zodiac' => 3,
        ],
        /** POISSON */
        [
            'id' => 10,
            'name' => 'Érudition',
            'domain' => true,
            'open' => false,
            'zodiac' => 4,
        ],
        [
            'id' => 11,
            'name' => 'Langues',
            'domain' => true,
            'open' => false,
            'zodiac' => 4,
        ],
        [
            'id' => 12,
            'name' => 'Sciences',
            'domain' => true,
            'open' => false,
            'zodiac' => 4,
        ],
        /** BELIER */
        [
            'id' => 13,
            'name' => 'Corps à corps',
            'domain' => false,
            'open' => true,
            'zodiac' => 5,
        ],
        [
            'id' => 14,
            'name' => 'Mélée',
            'domain' => false,
            'open' => true,
            'zodiac' => 5,
        ],
        [
            'id' => 15,
            'name' => 'Tactique',
            'domain' => false,
            'open' => true,
            'zodiac' => 5,
        ],
        /** TAUREAU */
        [
            'id' => 16,
            'name' => 'Athlétisme',
            'domain' => false,
            'open' => true,
            'zodiac' => 6,
        ],
        [
            'id' => 17,
            'name' => 'Endurance',
            'domain' => false,
            'open' => true,
            'zodiac' => 6,
        ],
        [
            'id' => 18,
            'name' => 'Force',
            'domain' => false,
            'open' => true,
            'zodiac' => 6,
        ],
        /** BALANCE */
        [
            'id' => 19,
            'name' => 'Documentation',
            'domain' => false,
            'open' => true,
            'zodiac' => 7,
        ],
        [
            'id' => 20,
            'name' => 'Fouille',
            'domain' => false,
            'open' => true,
            'zodiac' => 7,
        ],
        [
            'id' => 21,
            'name' => 'Intellect',
            'domain' => false,
            'open' => true,
            'zodiac' => 7,
        ],
        /** SCORPION */
        [
            'id' => 22,
            'name' => 'Discrétion',
            'domain' => false,
            'open' => true,
            'zodiac' => 8,
        ],
        [
            'id' => 23,
            'name' => 'Intrusion',
            'domain' => false,
            'open' => true,
            'zodiac' => 8,
        ],
        [
            'id' => 24,
            'name' => 'Subterfuge',
            'domain' => false,
            'open' => true,
            'zodiac' => 8,
        ],
        /** LION */
        [
            'id' => 25,
            'name' => 'Commandement',
            'domain' => false,
            'open' => true,
            'zodiac' => 9,
        ],
        [
            'id' => 26,
            'name' => 'Stratégie',
            'domain' => false,
            'open' => true,
            'zodiac' => 9,
        ],
        [
            'id' => 27,
            'name' => 'Volonté',
            'domain' => false,
            'open' => true,
            'zodiac' => 9,
        ],
        /** CAPRICORNE */
        [
            'id' => 28,
            'name' => 'Esquive',
            'domain' => false,
            'open' => true,
            'zodiac' => 10,
        ],
        [
            'id' => 29,
            'name' => 'Pilotage',
            'domain' => true,
            'open' => true,
            'zodiac' => 10,
        ],
        [
            'id' => 30,
            'name' => 'Rapidité',
            'domain' => false,
            'open' => true,
            'zodiac' => 10,
        ],
        /** CANCER */
        [
            'id' => 31,
            'name' => 'Artisanat',
            'domain' => true,
            'open' => true,
            'zodiac' => 11,
        ],
        [
            'id' => 32,
            'name' => 'Technologies',
            'domain' => true,
            'open' => false,
            'zodiac' => 11,
        ],
        [
            'id' => 33,
            'name' => 'Soins',
            'domain' => false,
            'open' => true,
            'zodiac' => 11,
        ],
        /** VERSEAU */
        [
            'id' => 34,
            'name' => 'Astrologie',
            'domain' => false,
            'open' => true,
            'zodiac' => 12,
        ],
        [
            'id' => 35,
            'name' => 'Histoire secrète',
            'domain' => false,
            'open' => false,
            'zodiac' => 12,
        ],
        [
            'id' => 36,
            'name' => 'Les 8',
            'domain' => false,
            'open' => false,
            'zodiac' => 12,
        ],


    ];


}
