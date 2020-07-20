<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class BackOfficeController extends AbstractController
{
    /**
     * @Route("/back/office", name="back_office")
     * @param BookRepository $repository
     * @param MemberRepository $members
     * @return  Response
     */
    public function index(BookRepository $repository, MemberRepository $members)
    {
        $latestBooks = $repository->findAll();
        $latestMembers = $members->findAll();

        return $this->render('back_office/index.html.twig', [

            'latestBooks' => $latestBooks,
            'members' => $latestMembers
        ]);
    }
}
