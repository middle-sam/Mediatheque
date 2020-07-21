<?php

namespace App\Controller;

use App\Repository\BorrowingRepository;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class BackOfficeController extends AbstractController
{
    /**
     * @Route("/back/office", name="back_office")
     * @param BookRepository $book
     * @param MemberRepository $members
     * @param BorrowingRepository $borrowed
     * @return  Response
     */
    public function index(BookRepository $book, MemberRepository $members, BorrowingRepository $borrowed)
    {
        $latestBooks = $book->findLatestBooks();
        $latestMembers = $members->findLatestMembers();
        $mostBorrowed = $borrowed->findMostBorrowed();


        return $this->render('back_office/index.html.twig', [

            'latestBooks' => $latestBooks,
            'members' => $latestMembers,
            'mostBorrowed' => $mostBorrowed,

        ]);
    }
}
