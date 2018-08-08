<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\VerseData;
use App\Entity\Adam;
use App\Entity\Verse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VerseFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        foreach( VerseData::$DATA as $data ){
            $verse = new Verse();

            /** @var Adam $adam */
            $adam = $this->getReference( 'adam-'.$data['adam_id'] );

            $verse
                ->setName( $data['name'] )
                ->setQuote( $data['quote'] )
                ->setKarma( $data['karma'] )
                ->setDuration( $data['duration'] )
                ->setVerseRange( $data['verseRange'] )
                ->setArea( $data['area'] )
                ->setStackable( $data['stackable'] )
                ->setDescription( $data['description'] )
                ->setAdam( $adam );

            $manager->persist( $verse );
            $manager->flush();

            $this->addReference('verse-'.$data['id'], $verse);
        }
    }

    public function getDependencies()
    {
        return array(
            AdamFixtures::class,
        );
    }
}
