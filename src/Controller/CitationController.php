<?php

namespace App\Controller;

use App\Repository\CitationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Citation;
use App\Form\CitationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/citation/nouvelle', name: 'app_citation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $citation = new Citation();
        $form = $this->createForm(CitationType::class, $citation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($citation);
            $entityManager->flush();

            $this->addFlash('success', 'La citation a bien été ajoutée.');

            return $this->redirectToRoute('app_citation_index');
        }

        return $this->render('citation/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/citation/{id}/modifier', name: 'app_citation_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Citation $citation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CitationType::class, $citation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();   // pas de persist : la citation existe déjà

            $this->addFlash('success', 'La citation a bien été modifiée.');

            return $this->redirectToRoute('app_citation_show', ['id' => $citation->getId()]);
        }

        return $this->render('citation/edit.html.twig', [
            'citation' => $citation,
            'form' => $form,
        ]);
    }

    #[Route('/citation/{id}/supprimer', name: 'app_citation_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Citation $citation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$citation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($citation);
            $entityManager->flush();

            $this->addFlash('success', 'La citation a été supprimée.');
        }

        return $this->redirectToRoute('app_citation_index');
    }
}