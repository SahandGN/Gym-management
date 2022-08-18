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


    public function membershipIdentifier($membershipId): ?\App\Entity\Membership
    {

        $memberships = $this->membershipRepository->findAll();

        foreach ($memberships as $membership) {
            if ($membership->getId() == $membershipId) {
                return $membership;
            }
        }
        return null;
    }

    public function buyMembership($membershipId)
    {
        $memberships = $this->membershipRepository->findAll();
        $token = $this->tokenStorage->getToken();

        /** @var User $loggedUser */
        $loggedUser = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        $users = $this->userRepository->findAll();

        foreach ($users as $u)
        {
            if ($u->getId() == $loggedUser->getId()){
                $user = $u;
            }
        }

        foreach ($memberships as $membership){
            if ($membership->getId() == $membershipId){
                $user->setMembership($membership);
                $user->setShoppedAt(new \DateTimeImmutable());
                $this->userRepository->add($user);
            }
        }

    }
}