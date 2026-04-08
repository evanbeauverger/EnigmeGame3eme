<?php

namespace App\Controller;

use App\Entity\Enigma;
use App\Entity\Type;
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

    #[Route('/new/{typeId}', name: 'app_enigma_new', methods: ['GET', 'POST'])]
    public function new(
    Request $request,
    EntityManagerInterface $entityManager,
    ?int $typeId = null
    ): Response {
        $enigma = new Enigma();

        if ($typeId) {
            $type = $entityManager->getRepository(Type::class)->find($typeId);
            $enigma->setType($type);
        }

        $form = $this->createForm(EnigmaType::class, $enigma, [
            'type_id' => $typeId
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enigma);
            $entityManager->flush();

            return $this->redirectToRoute('app_enigma_index');
        }

        return $this->render('enigma/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/choose-type', name: 'app_enigma_choose_type')]
    public function chooseType(EntityManagerInterface $em): Response
    {
        $types = $em->getRepository(Type::class)->findAll();

        return $this->render('enigma/type.html.twig', [
        'types' => $types
        ]);
    }

    #[Route('/{id}', name: 'app_enigma_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Enigma $enigma): Response
    {
        $typeLabel = $enigma->getType() ? $enigma->getType()->getLabel() : '';

        if ($request->isMethod('POST')) {
            $answer = $request->request->get('answer');

            $correct = $enigma->getSecretcode(); // réponse correcte

            // Normalisation : majuscules/minuscules et trim
            $answerNormalized = strtolower(trim($answer));
            $correctNormalized = strtolower(trim($correct));

            // Validation selon le type (mais pour l’instant on peut traiter tous pareil)
            if ($answerNormalized === $correctNormalized) {
                $session = $request->getSession();
                $resolved = $session->get('resolved_enigmas', []);

                if (!in_array($enigma->getId(), $resolved)) {
                    $resolved[] = $enigma->getId();
                }

                $session->set('resolved_enigmas', $resolved);

                return $this->redirectToRoute('app_menu_enigmes');
            }

            $this->addFlash('error', 'Mauvaise réponse, réessaie.');
        }

        return $this->render('enigma/show.html.twig', [
            'enigma' => $enigma,
            'typeLabel' => $typeLabel, // on passe le label pour Twig
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enigma_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Enigma $enigma, EntityManagerInterface $entityManager): Response
    {
        // Récupère l'ID du type de l'énigme existante
        $typeId = $enigma->getType() ? $enigma->getType()->getId() : null;

        // Passe le type_id au formulaire pour afficher les bons champs
        $form = $this->createForm(EnigmaType::class, $enigma, [
            'type_id' => $typeId
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_enigma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enigma/edit.html.twig', [
            'enigma' => $enigma,
            'form' => $form->createView(),
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
