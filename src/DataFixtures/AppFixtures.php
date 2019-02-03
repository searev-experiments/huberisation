<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername("bhuber");
        $user->setFirstName("Bastien");
        $user->setLastName("Huber");
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, 'password')
        );
        $user->setEmail("bastien@huberisation.fr");
        $user->setRoles(array(
            'ROLE_USER',
            'ROLE_ADMIN'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
