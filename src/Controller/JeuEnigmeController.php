<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuEnigmeController extends AbstractController
{
    #[Route('/', name: 'app_jeu_enigme')]
    public function index(): Response
    {
        return $this->render('jeu_enigme/index.html.twig');
    }

    #[Route('/equipe', name: 'app_equipe')]
    public function equipe(): Response
    {
        return $this->render('jeu_enigme/equipe.html.twig');
    }

    #[Route('/jeu', name: 'app_jeu')]
    public function jeu(): Response
    {
        return $this->render('jeu_enigme/jeu.html.twig');
    }
}
