<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('09131234567');
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('09138520852');
        $password = $this->hasher->hashPassword($user2, '123456');
        $user2->setPassword($password);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('09137654321');
        $password = $this->hasher->hashPassword($user3, '123456');
        $user3->setPassword($password);
        $manager->persist($user3);

        $manager->flush();
    }
}