<?php

namespace App\Controller;

use App\Repository\CitationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Citation;

final class CitationController extends AbstractController
{
    #[Route('/', name: 'app_citation_index', methods: ['GET'])]
    public function index(CitationRepository $citationRepository): Response
    {
        return $this->render('citation/index.html.twig', [
            'citations' => $citationRepository->findBy([], ['dateAjout' => 'DESC']),
        ]);
    }

    #[Route('/citation/{id}', name: 'app_citation_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Citation $citation): Response
    {
        return $this->render('citation/show.html.twig', [
            'citation' => $citation,
        ]);
    }
}