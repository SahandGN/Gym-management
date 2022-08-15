<?php

namespace App\Services;

use App\Entity\Locker;
use App\Repository\LockerRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class LockerService
{
    private $userRepository;
    private $lockerRepository;

    public function __construct(LockerRepository $lockerRepository, UserRepository $userRepository)
    {
        $this->lockerRepository = $lockerRepository;
        $this->userRepository = $userRepository;
    }


    public function checkAvailability()
    {


        /** @var locker[] $lockers */
        $lockers = $this->lockerRepository->findAll();

        /** @var User[] $user */
        $users = $this->userRepository->findAll();


        foreach ($lockers as $locker) {
            if ($locker->isIsEmpty()) {
                foreach ($users as $user) {
                    if ($user instanceof UserInterface) {
                        $locker->setOwner($user);
                        $locker->setIsEmpty(false);
                        $this->lockerRepository->add($locker,true);
                        return true;
                    }
                }
            }
        }
        return false;
    }
}