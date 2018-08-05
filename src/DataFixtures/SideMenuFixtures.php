<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\SideMenuData;
use App\Entity\SideMenu;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SideMenuFixtures extends Fixture
{



    public function load( ObjectManager $manager )
    {
        foreach( SideMenuData::$DATA as $data ){
            $sideMenu = new SideMenu();
            $sideMenu
                ->setTitle( $data['title'] )
                ->setRoute( $data['route'] )
                ->setMaster( $data['master'] )
                ->setPlayer( $data['player'] );

            $manager->persist( $sideMenu );
            $manager->flush();

            $this->addReference('sideMenu-'.$data['id'], $sideMenu);
        }


    }
}
