<?php

namespace App\Controller;

use App\Entity\Membership;
use App\Entity\User;
use App\Services\LockerService;
use App\Services\MembershipService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(MembershipService $membershipService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();

        if ($user->getMembership() != null) {
            /** @var Membership $membership */
            $m = $user->getMembership();
            $membership = $membershipService->membershipIdentifier($m->getId());


            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
                'user' => $user,
                'membership' => $membership,
            ]);
        }
    }

    #[Route('/locker', name: 'app_user_locker', methods: ['GET', 'POST'])]
    public function assignLocker(LockerService $lockerService)
    {
        $available = $lockerService->checkAvailability();

        if ($available) {
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }
        return error_log("error",1);
    }
}
