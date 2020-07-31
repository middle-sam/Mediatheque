<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function index(BookRepository $bookRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $Allbooks = $paginator->paginate($bookRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('book/index.html.twig', [
            'books' => $Allbooks,
        ]);
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     * @param Request $request
     * @param Paginator $paginator
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function new(Request $request, PaginatorInterface $paginator, BookRepository $bookRepository): Response
    {

        $allBooks = $paginator->paginate($bookRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //echo $book->getUpdatedAt()->format('d-m-Y');die();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nouveau document crée avec succès!'
            );

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'books' => $allBooks,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): Response
    {

        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Mise à jour effectuée avec succès!'
            );

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
