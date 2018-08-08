<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\AuraData;
use App\DataFixtures\Data\JobData;
use App\Entity\Aura;
use App\Entity\Job;
use App\Entity\Skill;
use App\Entity\Zodiac;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class JobFixtures extends Fixture implements DependentFixtureInterface
{

    public function load( ObjectManager $manager )
    {
        foreach( JobData::$DATA as $data ){
            $job = new Job();


            $job
                ->setName( $data['name'] )
                ->setWealth($data['wealth'])
                ->setNetwork( $data ['network'] )
                ->setInfluence( $data ['influence'])
                ->setNumberOfDomains( $data ['numberOfDomains'])
                ->setDomains( $data ['domains'])
                ->setCreationPoints( $data ['creationPoints']);

            foreach ( $data['skills_array'] as $skillId ){
                /** @var Skill $skill */
                $skill = $this->getReference('skill-'.$skillId);
                $job->addSkill($skill);
            }


            $manager->persist( $job );
            $manager->flush();

            $this->addReference('job-'.$data['id'], $job);
        }


    }

    public function getDependencies()
    {
        return array(
            SkillFixtures::class,
        );
    }

}
