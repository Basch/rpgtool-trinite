<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\UserData;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder )
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load( ObjectManager $manager )
    {
        foreach ( UserData::$DATA as $data ) {
            $user = new User();
            $user->setUsername( $data['username'] );
            $user->setEnabled( 1 );
            $user->setPassword(
                $this->passwordEncoder->encodePassword( $user, $data['password'] )
            );
            $user->setEmail( $data['email'] );
            $user->setRoles( $data['roles'] );

            $manager->persist( $user );

            $this->addReference('user-'.$data['id'], $user);
        }

        $manager->flush();
    }
}
