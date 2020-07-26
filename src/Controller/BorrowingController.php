<?php

namespace App\Controller;

use App\Entity\Borrowing;
use App\Form\BorrowingType;
use App\Repository\BorrowingRepository;
use App\Service\RelaunchManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/borrowing")
 */
class BorrowingController extends AbstractController
{

    /**
     * @Route("/eb", name="expectedBorrowings", methods={"GET"})
     * @param BorrowingRepository $borrowing
     * @param RelaunchManager $relaunch
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function expiredBorrowings(BorrowingRepository $borrowing, RelaunchManager $relaunch, \Swift_Mailer $mailer): Response
    {
        //$message = $expiredBorrowings->getBorrowingsMessage();
        //$this->addFlash('alert', $message);
        $queryResult = $borrowing->findExpiredBorrowingsByMember();

        $date = new \DateTime;
        $ds= $date->format('Y-m-d H:i:s');
        echo $ds;

        foreach($queryResult as $qr){

            $interval = date_diff($date, $qr->getExpectedReturnDate());
            $dss = floor(intval($interval->format('%a'))/7);
            echo $dss.' '.$qr->getId();
            echo '</br>';
            $tab[] = $dss;
        }




        return $this->render('borrowing/expiredBorrowings.html.twig', [
            'expiredBorrowings' => $borrowing->findExpiredBorrowingsByMember(),
            'expiredMessage'=> $relaunch->getBorrowingsMessage(),
            'now' => $date,
            'diff' => $tab
        ]);
    }

    /**
     * @Route("/", name="borrowing_index", methods={"GET"})
     */
    public function index(BorrowingRepository $borrowingRepository): Response
    {
        return $this->render('borrowing/index.html.twig', [
            'borrowings' => $borrowingRepository->findAll(),
        ]);
    }



    /**
     * @Route("/new", name="borrowing_new", methods={"GET","POST"})
     */
    public function new(Request $request, RelaunchManager $relaunch, BorrowingRepository $borrowingRepository): Response
    {
        $borrowing = new Borrowing();
        $form = $this->createForm(BorrowingType::class, $borrowing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($borrowing);
            $entityManager->flush();

            $relaunch->notify($borrowingRepository);

            $this->addFlash(
                'success',
                'Nouvel emprunt crée avec succès!'
            );

            return $this->redirectToRoute('borrowing_index');
        }//elseif ($form->isSubmitted() && $form->isValid() ){
         //   $this->addFlash(
         //       'warning',
         //       'Une erreur est survenue lors de la création'
         //   );
        //}//

        return $this->render('borrowing/new.html.twig', [
            'borrowing' => $borrowing,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="borrowing_show", methods={"GET"})
     */
    public function show(Borrowing $borrowing): Response
    {
        return $this->render('borrowing/show.html.twig', [
            'borrowing' => $borrowing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="borrowing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Borrowing $borrowing): Response
    {
        $form = $this->createForm(BorrowingType::class, $borrowing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Mise à jour effectuée avec succès!'
            );


            return $this->redirectToRoute('borrowing_index');
        }//else{
         //   $this->addFlash(
         //       'warning',
         //       'Une erreur est survenue lors de la mise à jour'
         //   );
        //}//

        return $this->render('borrowing/edit.html.twig', [
            'borrowing' => $borrowing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="borrowing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Borrowing $borrowing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borrowing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($borrowing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('borrowing_index');
    }
}
