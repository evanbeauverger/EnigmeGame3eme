<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EnseignantController extends AbstractController
{
    #[Route('/enseignant', name: 'app_enseignant')]
    public function index(): Response
    {
        return $this->render('enseignant/index.html.twig');
    }

    #[Route('/enseignant/domaine_jeu', name: 'app_domaine_jeu')]
    public function damaine_jeu(): Response
    {
        return $this->render('enseignant/domaine_jeu.html.twig');
    }

    #[Route('/enseignant/parties', name: 'app_parties')]
    public function parties(): Response
    {
        return $this->render('enseignant/parties.html.twig');
    }

    #[Route('/enseignant/historique', name: 'app_historique')]
    public function historique(): Response
    {
        return $this->render('enseignant/historique.html.twig');
    }
}
