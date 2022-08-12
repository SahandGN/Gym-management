<?php

namespace App\Controller;

use App\Entity\Locker;
use App\Form\LockerType;
use App\Repository\LockerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/locker')]
class LockerController extends AbstractController
{
    #[Route('/', name: 'app_locker_index', methods: ['GET'])]
    public function index(LockerRepository $lockerRepository): Response
    {
        return $this->render('locker/index.html.twig', [
            'lockers' => $lockerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_locker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LockerRepository $lockerRepository): Response
    {
        $locker = new Locker();
        $form = $this->createForm(LockerType::class, $locker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lockerRepository->add($locker, true);

            return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('locker/new.html.twig', [
            'locker' => $locker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_locker_show', methods: ['GET'])]
    public function show(Locker $locker): Response
    {
        return $this->render('locker/show.html.twig', [
            'locker' => $locker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_locker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Locker $locker, LockerRepository $lockerRepository): Response
    {
        $form = $this->createForm(LockerType::class, $locker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lockerRepository->add($locker, true);

            return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('locker/edit.html.twig', [
            'locker' => $locker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_locker_delete', methods: ['POST'])]
    public function delete(Request $request, Locker $locker, LockerRepository $lockerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locker->getId(), $request->request->get('_token'))) {
            $lockerRepository->remove($locker, true);
        }

        return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/open', name: 'app_locker_open', methods: ['GET','POST'])]
    public function openLocker(Request $request, Locker $locker, LockerRepository $lockerRepository): Response
    {
        $locker->setIsEmpty(!$locker->isIsEmpty());
        $lockerRepository->add($locker, true);
        return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
    }
}
