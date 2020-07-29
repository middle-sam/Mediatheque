<?php

namespace App\Controller;

use App\Entity\Participates;
use App\Form\ParticipatesType;
use App\Repository\ParticipatesRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @param ParticipatesRepository $participatesRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ParticipatesRepository $participatesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $allParticipates = $paginator->paginate($participatesRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );


        return $this->render('participates/index.html.twig', [
            'participates' => $allParticipates,
            /**
             * le résultat de sumofplaces a été injecyé dans la vue par le biais du filtre sumOfPlacesByMeetup
             * cela permet de contourner simplement le problème de l'injection de plusieurs variables dans une même boucle for du template
             */
            //'sumofplaces' => $participatesRepository->sumOfPlacesByMeetup(12)
        ]);
    }

    /**
     * @Route("/new", name="participates_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
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
