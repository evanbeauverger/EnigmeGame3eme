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

    #[Route('/jeu3', name: 'app_jeu3')]
    public function jeu3(): Response
    {
        return $this->render('jeu_enigme/jeu3.html.twig');
    }

    #[Route('/jeu4', name: 'app_jeu4')]
    public function jeu4(): Response
    {
        return $this->render('jeu_enigme/jeu4.html.twig');
    }

    #[Route('/jeu5', name: 'app_jeu5')]
    public function jeu5(): Response
    {
        return $this->render('jeu_enigme/jeu5.html.twig');
    }

    #[Route('/enigma1', name: 'app_enigma1')]
    public function engime1(Request $request): Response
    {
        $resultat = null;

        if ($request->isMethod('POST')) {
            $reponse = strtolower(trim($request->request->get('reponse')));

            if ($reponse === 'openai') {
                return $this->render('jeu_enigme/jeu2.html.twig');
            } else {
                $resultat = "Mauvaise réponse, essaie encore !";
            }
        }

        return $this->render('jeu_enigme/enigma1.html.twig', [
            'resultat' => $resultat,
        ]);
    }

    #[Route('/enigma2', name: 'app_enigma2')]
    public function engime2(Request $request): Response
    {
        $resultat = null;

        if ($request->isMethod('POST')) {
            $reponse = strtolower(trim($request->request->get('reponse')));

            if ($reponse === '1950') {
                return $this->render('jeu_enigme/jeu3.html.twig');
            } else {
                $resultat = "Mauvaise réponse, essaie encore !";
            }
        }

        return $this->render('jeu_enigme/enigma2.html.twig', [
            'resultat' => $resultat,
        ]);
    }

    #[Route('/enigma3', name: 'app_enigma3')]
    public function engime3(): Response
    {
        return $this->render('jeu_enigme/enigma3.html.twig');
    }

    #[Route('/enigma4', name: 'app_enigma4')]
    public function engime4(): Response
    {
        return $this->render('jeu_enigme/enigma4.html.twig');
    }

    #[Route('/enigma5', name: 'app_enigma5')]
    public function engime5(): Response
    {
        return $this->render('jeu_enigme/enigma5.html.twig');
    }

    #[Route('/enigma/{id}', name: 'app_enigma')]
    public function engime(EnigmaRepository $enigmaRepository, int $id): Response
    {
        $enigma = $enigmaRepository->find($id);
        return $this->render('jeu_enigme/enigme1.html.twig', ['enigma' => $enigma]);
    }
}
