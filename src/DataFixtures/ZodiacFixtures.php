<?php

namespace App\DataFixtures;

use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ZodiacFixtures extends Fixture
{

    private $data = [
        [ 'id' => 1, 'name' => 'Gémeaux' ],
        [ 'id' => 2, 'name' => 'Vierge' ],
        [ 'id' => 3, 'name' => 'Sagittaire' ],
        [ 'id' => 4, 'name' => 'Poisson' ],
        [ 'id' => 5, 'name' => 'Bélier' ],
        [ 'id' => 6, 'name' => 'Taureau' ],
        [ 'id' => 7, 'name' => 'Balance' ],
        [ 'id' => 8, 'name' => 'Scorpion' ],
        [ 'id' => 9, 'name' => 'Lion' ],
        [ 'id' => 10, 'name' => 'Capricorne' ],
        [ 'id' => 11, 'name' => 'Cancer' ],
        [ 'id' => 12, 'name' => 'Verseau' ],
    ];

    public function load( ObjectManager $manager )
    {
        foreach( $this->data as $data ){
            $zodiac = new Zodiac();
            $zodiac
              ->setName( $data['name'] );
            $manager->persist( $zodiac );
            $manager->flush();

            $this->addReference('zodiac-'.$data['id'], $zodiac);
        }


    }
}
