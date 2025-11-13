<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/teacher')]
final class TeacherController extends AbstractController
{
    #[Route(name: 'app_teacher', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    #[Route('/gestion', name: 'app_gestion')]
    public function gestion(): Response
    {
        return $this->render('teacher/gestion.html.twig');
    }
}
