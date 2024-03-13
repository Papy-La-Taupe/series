<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/series', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route("", name: 'list')]
    public function list(): Response
    {
        //todo: aller chercher les séries en BDD
        return $this->render('serie/list.html.twig', [
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details($id): Response
    {
        //todo: aller chercher la série en BDD
        return $this->render('serie/details.html.twig', [
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        //todo: aller chercher la série en BDD
        return $this->render('serie/create.html.twig', [
        ]);
    }
}
