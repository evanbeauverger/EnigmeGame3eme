<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\EnigmaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
    
    #[Route('/menu_enigmes', name: 'app_menu_enigmes')]
    public function menu_enigmes( EnigmaRepository $enigmaRepository ): Response
    {
        $enigma = $enigmaRepository->findAll();
        return $this->render('jeu_enigme/menu_enigmes.html.twig', [
            'enigma' => $enigma,
        ]);
    }

    #[Route('/enigma/{id}', name: 'app_enigma')]
    public function engime( EnigmaRepository $enigmaRepository ): Response
    {
        $enigma = $enigmaRepository->find($id);

        return $this->render('enigma/show.html.twig', [
            'enigma' => $enigma,
        ]);
    }
}
