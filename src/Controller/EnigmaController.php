<?php

namespace App\Controller;

use App\Entity\Enigma;
use App\Form\EnigmaType;
use App\Repository\EnigmaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/enigma')]
final class EnigmaController extends AbstractController
{
    #[Route(name: 'app_enigma_index', methods: ['GET'])]
    public function index(EnigmaRepository $enigmaRepository): Response
    {
        return $this->render('enigma/index.html.twig', [
            'enigmas' => $enigmaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enigma_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $enigma = new Enigma();
        $form = $this->createForm(EnigmaType::class, $enigma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enigma);
            $entityManager->flush();

            return $this->redirectToRoute('app_enigma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enigma/new.html.twig', [
            'enigma' => $enigma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigma_show', methods: ['GET'])]
    public function show(Enigma $enigma): Response
    {
        return $this->render('enigma/show.html.twig', [
            'enigma' => $enigma,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enigma_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Enigma $enigma, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EnigmaType::class, $enigma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_enigma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enigma/edit.html.twig', [
            'enigma' => $enigma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigma_delete', methods: ['POST'])]
    public function delete(Request $request, Enigma $enigma, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enigma->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($enigma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_enigma_index', [], Response::HTTP_SEE_OTHER);
    }
}
