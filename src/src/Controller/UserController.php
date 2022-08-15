<?php

namespace App\Controller;

use App\Services\LockerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
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
}
