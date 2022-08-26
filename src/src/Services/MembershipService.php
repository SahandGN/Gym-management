<?php

namespace App\Services;

use App\Entity\Membership;
use App\Entity\User;
use App\Repository\MembershipRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MembershipService
{

    private $membershipRepository;
    private $tokenStorage;
    private $userRepository;


    public function __construct(MembershipRepository $membershipRepository, TokenStorageInterface $tokenStorage,
                                UserRepository       $userRepository)
    {
        $this->membershipRepository = $membershipRepository;
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $userRepository;
    }


    public function membershipClassReducer()
    {

        $token = $this->tokenStorage->getToken();

        /** @var User $user */
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        if ( 0 < $user->getNumberOfClasses()){
        $user->setNumberOfClasses($user->getNumberOfClasses() - 1);
        return true;
        }
        return false;
    }

    public function buyMembership(Membership $membership)
    {

        $token = $this->tokenStorage->getToken();

        /** @var User $user */
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        $user->setMembership($membership);
        $user->setNumberOfClasses($membership->getNumberOfClasses());
        $user->setShoppedAt(new \DateTimeImmutable());
        $this->userRepository->add($user,true);

    }

    public function remainingDays ()
    {
//        $date = $user->getShoppedAt();
//        $interval = new DateInterval('P1M');
//        echo $date->format('Y-m-d') . "\n";
//        $newDate1 = $date->add($interval);
//        echo $newDate1->format('Y-m-d') . "\n";
//
//        $difdate = $date->
//        echo $difdate->format('Y-m-d') . "\n";
//
//        $newDate2 = $newDate1->add($interval);
//        echo $newDate2->format('Y-m-d') . "\n";

    }
}