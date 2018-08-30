<?php

namespace App\DataFixtures;

use App\Entity\Campaign;
use App\Entity\PlayerCharacter;
use App\Entity\Report;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReportFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var Campaign[] $campaigns */
        $campaigns = $manager->getRepository( Campaign::class )->findAll();

        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();

        foreach( $characters as $character ) foreach ( $campaigns as $campaign )
        if ( $campaign->getCharacters()->contains( $character ) ){
            $report = new Report();

            $report
                ->setTitle( ' Rapport de '.$character->getName() )
                ->setText( 'yolo' )
                ->setDateGame( new \DateTime() )
                ->setCampaign( $campaign )
                ->setWriter( $character )
                ->setCreator( $character->getUser() )
                ;


            $manager->persist( $report );


        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AdamFixtures::class,
        );
    }
}
