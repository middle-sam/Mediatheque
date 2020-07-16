<?php

namespace App\Controller;

use App\Entity\IsInvolvedIn;
use App\Form\IsInvolvedInType;
use App\Repository\IsInvolvedInRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/is/involved/in")
 */
class IsInvolvedInController extends AbstractController
{
    /**
     * @Route("/", name="is_involved_in_index", methods={"GET"})
     */
    public function index(IsInvolvedInRepository $isInvolvedInRepository): Response
    {
        return $this->render('is_involved_in/index.html.twig', [
            'is_involved_ins' => $isInvolvedInRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="is_involved_in_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $isInvolvedIn = new IsInvolvedIn();
        $form = $this->createForm(IsInvolvedInType::class, $isInvolvedIn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($isInvolvedIn);
            $entityManager->flush();

            return $this->redirectToRoute('is_involved_in_index');
        }

        return $this->render('is_involved_in/new.html.twig', [
            'is_involved_in' => $isInvolvedIn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="is_involved_in_show", methods={"GET"})
     */
    public function show(IsInvolvedIn $isInvolvedIn): Response
    {
        return $this->render('is_involved_in/show.html.twig', [
            'is_involved_in' => $isInvolvedIn,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="is_involved_in_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IsInvolvedIn $isInvolvedIn): Response
    {
        $form = $this->createForm(IsInvolvedInType::class, $isInvolvedIn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('is_involved_in_index');
        }

        return $this->render('is_involved_in/edit.html.twig', [
            'is_involved_in' => $isInvolvedIn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="is_involved_in_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IsInvolvedIn $isInvolvedIn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$isInvolvedIn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($isInvolvedIn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('is_involved_in_index');
    }
}
