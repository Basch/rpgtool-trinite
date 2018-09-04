<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\MenuData;
use App\Entity\Menu;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{



    public function load( ObjectManager $manager )
    {
        foreach( MenuData::$DATA as $data ){
            $sideMenu = new Menu();
            $sideMenu
                ->setTitle( $data['title'] )
                ->setRoute( $data['route'] )
                ->setIcon( $data['icon'] )
                ->setMaster( $data['master'] )
                ->setPlayer( $data['player'] );

            $manager->persist( $sideMenu );
            $manager->flush();

            $this->addReference('sideMenu-'.$data['id'], $sideMenu);
        }


    }
}
