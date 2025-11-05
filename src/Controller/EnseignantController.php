<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EnseignantController extends AbstractController
{
    public function __construct(
        private FormFactoryInterface $formFactory
    ){}

    #[Route('/enseignant/create', name: 'app_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $enseignant = new Enseignant();
        $form = $this->formFactory->create(EnseignantType::class, $enseignant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enseignant);
            $entityManager->flush();

            return $this->redirectToRoute('app_connexion');
        }

        return $this->render('enseignant/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('enseignant/connexion.html.twig');
    }

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
