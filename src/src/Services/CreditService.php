<?php

namespace App\Services;

use App\Entity\Membership;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreditService
{
    private $tokenStorage;
    private $userRepository;
    private $membershipService;

    public function __construct(TokenStorageInterface $tokenStorage, UserRepository $userRepository, MembershipService $membershipService)
    {
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $userRepository;
        $this->membershipService = $membershipService;
    }

    public function buy(object $entity)
    {

        $token = $this->tokenStorage->getToken();
        /** @var User $user */
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        if ($entity instanceof Product || $entity instanceof Membership) {
            if ($entity->getPrice() < $user->getCredit()) {
                $user->setCredit($user->getCredit() - $entity->getPrice());
                if ($entity instanceof Membership) {
                    $this->membershipService->buyMembership($entity);
                }
                $this->userRepository->add($user, true);
            }
        }


    }
}