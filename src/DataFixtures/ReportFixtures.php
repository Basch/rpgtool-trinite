<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReportFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
//        $campaigns_data = CampaignData::$DATA;
//        foreach( ReportData::$DATA as $data ) foreach ( $campaigns_data as $campaign_data ) {
//            $report = new Report();
//
//            /** @var Adam $adam */
//            $adam = $this->getReference( 'adam-'.$data['adam_id'] );
//
//            /** @var Campaign $campaign */
//            $campaign = $this->getReference('campaign-'. $campaign_data['id'] );
//
//            /*$report
//                ->setCampaign( $campaign )
//                ->setName( $data['name'] )
//                ->setQuote( $data['quote'] )
//                ->setKarma( $data['karma'] )
//                ->setDuration( $data['duration'] )
//                ->setVerseRange( $data['verseRange'] )
//                ->setArea( $data['area'] )
//                ->setStackable( $data['stackable'] )
//                ->setDescription( $data['description'] )
//                ->setAdam( $adam );
//
//            $manager->persist( $report );
//            $manager->flush();
//
//            $this->addReference('report-'. $campaign_data['id'] .'-'.$data['id'], $report);*/
//        }
    }

    public function getDependencies()
    {
        return array(
            AdamFixtures::class,
        );
    }
}
