<?php

namespace App\Controller;

use App\Entity\Borrowing;
use App\Form\BorrowingType;
use App\Repository\BorrowingRepository;
use App\Service\RelaunchManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/borrowing")
 */
class BorrowingController extends AbstractController{

    /**
     * @Route("/eb", name="expiredBorrowings", methods={"GET"})
     * @param BorrowingRepository $expiredBorrowings
     * @param RelaunchManager $relaunch
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function expectedBorrowings(BorrowingRepository $expiredBorrowings, RelaunchManager $relaunch): Response
    {
        //Utiliser $mailer pour l'envoi des mails

        /**
         * Calcule de la différence en semaines entre expectedreturndate et now
         * création d'un aray liant les emprunts.id et le niveau de relance en fonction de cette !=
         */
        $queryResult = $expiredBorrowings->findExpiredBorrowingsByMember();
        $date = new \DateTime;
        $tab = [];
        foreach ($queryResult as $qr) {

            $interval = date_diff($date, $qr->getExpectedReturnDate());
            $diffInWeeks = floor(intval($interval->format('%a')) / 7);

            if($diffInWeeks<2){
                $tab[$qr->getId()] = 'première relance';
            }elseif($diffInWeeks > 2 && $diffInWeeks<4){
                $tab[$qr->getId()] = 'seconde relance';
            }else{
                $tab[$qr->getId()] = 'dernière relance';
            }
        }
        /**
         * Envoi des mails aux membres dont les emprunts ont expiré
         */
        foreach ($queryResult as $qr) {
            $relaunch->notify($qr,$expiredBorrowings);
        }

        /**
         * Rendu de la vue
         */
        return $this->render('borrowing/expiredBorrowings.html.twig', [
            'expiredBorrowings' => $expiredBorrowings->findExpiredBorrowingsByMember(),
            'now' => $date,
            'expiredMessage'=> $relaunch->getBorrowingsMessage(),
            'tab' => $tab
        ]);
    }

    /**
     * @Route("/", name="borrowing_index", methods={"GET"})
     * @param BorrowingRepository $borrowingRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(BorrowingRepository $borrowingRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $allBorrowings = $paginator->paginate($borrowingRepository->findIndex(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('borrowing/index.html.twig', [
            'borrowings' => $allBorrowings,
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
     * @Route("/{id}", name="borrowing_show", methods={"GET"}, requirements= {"id"="\d+"})
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
     * @Route("/{id}", name="borrowing_delete", methods={"DELETE"}, requirements= {"id"="\d+"})
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
