<?php

namespace App\Services;

use App\Repository\MembershipRepository;

class MembershipService
{

    private $membershipRepository;


    public function __construct(MembershipRepository $membershipRepository)
    {
        $this->membershipRepository = $membershipRepository;
    }


    public function membershipIdentifier ($membershipId): ?\App\Entity\Membership
    {

        $memberships = $this->membershipRepository->findAll();

        foreach ($memberships as $membership){
            if ($membership->getId() == $membershipId){
                return $membership;
            }
        }
        return null;
    }
}