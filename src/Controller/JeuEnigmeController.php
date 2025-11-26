<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class JeuEnigmeController extends AbstractController
{

    public function __construct(
        private FormFactoryInterface $formFactory
    ){}

    #[Route('/', name: 'app_jeu_enigme')]
    public function index(): Response
    {
        return $this->render('jeu_enigme/index.html.twig');
    }

    #[Route('/equipe', name: 'app_equipe')]
    public function equipe(): Response
    {
        return $this->render('user/equipe.html.twig');
    }

    #[Route('/team_create', name: 'app_team_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $form = $this->formFactory->create(TeamType::class, $team);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('app_jeu');
        }

        return $this->render('jeu_enigme/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/jeu1', name: 'app_jeu1')]
    public function jeu1(): Response
    {
        return $this->render('jeu_enigme/jeu1.html.twig');
    }

    #[Route('/jeu2', name: 'app_jeu2')]
    public function jeu2(): Response
    {
        return $this->render('jeu_enigme/jeu2.html.twig');
    }

    #[Route('/enigma1', name: 'app_enigma1')]
    public function engime1(): Response
    {
        return $this->render('jeu_enigme/enigma1.html.twig');
    }
}
