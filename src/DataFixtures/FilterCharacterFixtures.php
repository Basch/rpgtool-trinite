<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\Aura;
use App\Entity\FilterCharacter;
use App\Entity\PlayerCharacter;
use App\Entity\Report;
use App\Entity\Verse;
use App\Model\FiltrableItemInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FilterCharacterFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var PlayerCharacter[] $characters */
        $characters = $manager->getRepository( PlayerCharacter::class )->findAll();


        $classes = [ Asset::class, Aura::class, Verse::class, Report::class ];

        /** @var FiltrableItemInterface[][] $items */
        $items = [];
        foreach( $classes as $class ){
            $items[ $class ] = $manager->getRepository( $class )->findAll();
        }

        foreach( $characters as $character ) foreach( $items as $class => $array ) foreach ( $array as $item ) if( $character->getCampaign()->getMaster() === $item->getCreator() ) {

            $filterCharacter = new FilterCharacter();
            $filterCharacter
                ->setCharacter( $character )
                ->setCampaign( $character->getCampaign() )
                ->setItemId( $item->getId() )
                ->setItemType( $class )
                ->setOwned( false )
                ->setVisible( true );

            $manager->persist( $filterCharacter );

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CharacterFixtures::class,
            AssetFixtures::class,
            AuraFixtures::class,
            VerseFixtures::class,
        );
    }
}
