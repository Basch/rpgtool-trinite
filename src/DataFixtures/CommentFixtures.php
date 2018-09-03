<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Report;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        /** @var Report[] $reports */
        $reports = $manager->getRepository( Report::class )->findAll();

        foreach ( $reports as $report ) foreach ( $report->getCampaign()->getCharacters() as $character ){

            $comment = new Comment();
            $comment
                ->setWriter( $character )
                ->setDateGame( new \DateTime() )
                ->setText('Commentaire de '.$character->getName() )
                ->setItemId( $report->getId() )
                ->setItemType( Report::class );

            $manager->persist( $comment );
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ReportFixtures::class,
        );
    }
}