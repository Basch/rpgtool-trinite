<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $usersdata = [
        [
            'username' => 'basch',
            'password' => 'pass',
            'email' => 'ced_46000@hotmail.com',
            'roles' => [ 'ROLE_SUPER_ADMIN' ],
        ],
    ];

    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder )
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load( ObjectManager $manager )
    {
        foreach ( $this->usersdata as $userdata ) {
            $user = new User();
            $user->setUsername( $userdata['username'] );
            $user->setEnabled( 1 );
            $user->setPassword(
                $this->passwordEncoder->encodePassword( $user, $userdata['password'] )
            );
            $user->setEmail( $userdata['email'] );
            $user->setRoles( $userdata['roles'] );

            $manager->persist( $user );
        }

        $manager->flush();
    }
}
