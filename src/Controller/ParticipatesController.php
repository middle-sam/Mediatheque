<?php

namespace App\Controller;

use App\Entity\Participates;
use App\Form\ParticipatesType;
use App\Repository\ParticipatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participates")
 */
class ParticipatesController extends AbstractController
{
    /**
     * @Route("/", name="participates_index", methods={"GET"})
     */
    public function index(ParticipatesRepository $participatesRepository): Response
    {
        return $this->render('participates/index.html.twig', [
            'participates' => $participatesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="participates_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participate = new Participates();
        $form = $this->createForm(ParticipatesType::class, $participate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participate);
            $entityManager->flush();

            return $this->redirectToRoute('participates_index');
        }

        return $this->render('participates/new.html.twig', [
            'participate' => $participate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participates_show", methods={"GET"})
     */
    public function show(Participates $participate): Response
    {
        return $this->render('participates/show.html.twig', [
            'participate' => $participate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participates_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Participates $participate): Response
    {
        $form = $this->createForm(ParticipatesType::class, $participate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participates_index');
        }

        return $this->render('participates/edit.html.twig', [
            'participate' => $participate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participates_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Participates $participate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participates_index');
    }
}
