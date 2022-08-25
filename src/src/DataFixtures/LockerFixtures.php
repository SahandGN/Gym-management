<?php

namespace App\DataFixtures;

use App\Entity\Locker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LockerFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++)
        {
            $locker = new Locker();
            $locker->setNumber($i);
            $locker->setIsEmpty(true);
            $manager->persist($locker);
            $manager->flush();
        }
    }
}