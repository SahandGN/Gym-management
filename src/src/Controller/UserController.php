<?php

namespace App\Controller;

use App\Entity\Membership;
use App\Entity\User;
use App\Repository\MembershipRepository;
use App\Repository\UserRepository;
use App\Services\LockerService;
use App\Services\MembershipService;
use DateInterval;
use DateTimeImmutable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();


            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
                'user' => $user,
            ]);
        }

    #[Route('/{id}/locker', name: 'app_user_locker', methods: ['GET', 'POST'])]
    public function assignLocker(User $user,LockerService $lockerService,
                                 MembershipService $membershipService, UserRepository $userRepository)
    {
        $available = $lockerService->checkAvailability();
        $reducer = $membershipService->membershipClassReducer();

        if ($available && $reducer) {
            $userRepository->add($user,true);
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }
        return error_log("error",1);
    }

    #[Route('/{id}/emptylocker', name: 'app_user_locker_empty', methods: ['GET', 'POST'])]
    public function emptyLocker(User $user,LockerService $lockerService,
                                 MembershipService $membershipService, UserRepository $userRepository)
    {
        $empty = $lockerService->emptyLocker($user);

        if ($empty) {
            $userRepository->add($user,true);
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }
        return error_log("error",1);
    }
}
