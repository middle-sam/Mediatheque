<?php

namespace App\Controller;

use App\Entity\Cd;
use App\Form\CdType;
use App\Repository\CdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cd")
 */
class CdController extends AbstractController
{
    /**
     * @Route("/", name="cd_index", methods={"GET"})
     */
    public function index(CdRepository $cdRepository): Response
    {
        return $this->render('cd/index.html.twig', [
            'cds' => $cdRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cd = new Cd();
        $form = $this->createForm(CdType::class, $cd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cd);
            $entityManager->flush();

            return $this->redirectToRoute('cd_index');
        }

        return $this->render('cd/new.html.twig', [
            'cd' => $cd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cd_show", methods={"GET"})
     */
    public function show(Cd $cd): Response
    {
        return $this->render('cd/show.html.twig', [
            'cd' => $cd,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cd $cd): Response
    {
        $form = $this->createForm(CdType::class, $cd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cd_index');
        }

        return $this->render('cd/edit.html.twig', [
            'cd' => $cd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cd_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cd $cd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cd->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cd_index');
    }
}
