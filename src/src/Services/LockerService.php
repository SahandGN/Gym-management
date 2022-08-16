<?php

namespace App\Services;

use App\Entity\Locker;
use App\Entity\User;
use App\Repository\LockerRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LockerService
{
    private $lockerRepository;
    private $tokenStorage;

    public function __construct(LockerRepository $lockerRepository, TokenStorageInterface $tokenStorage)
    {
        $this->lockerRepository = $lockerRepository;
        $this->tokenStorage = $tokenStorage;
    }


    public function checkAvailability()
    {


        /** @var locker[] $lockers */
        $lockers = $this->lockerRepository->findAll();

        $token = $this->tokenStorage->getToken();
        /** @var User $user */
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();
        
        $user->setLocker(null);
        foreach ($lockers as $locker) {
            if ($locker->isIsEmpty()) {
                $locker->setOwner($user);
                $locker->setIsEmpty(false);
                $this->lockerRepository->add($locker, true);
                return true;
            }
        }
        return false;
    }
}