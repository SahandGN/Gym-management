<?php

namespace App\Controller;

use App\Entity\Membership;
use App\Entity\User;
use App\Repository\MembershipRepository;
use App\Repository\UserRepository;
use App\Services\LockerService;
use App\Services\MembershipService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
                'user' => $user,
            ]);
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

    #[Route('/{user_id}/buy', name: 'app_user_buy_membership', methods: ['GET'])]
    #[ParamConverter('user', options: ['mapping' => ['user_id' => 'id']])]
//    #[ParamConverter('membership', options: ['mapping' => ['membership_id' => 'id']])]
    public function buyMembership(User $user): Response
    {
        echo $user->getUsername();
        exit();

        return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
    }
}
