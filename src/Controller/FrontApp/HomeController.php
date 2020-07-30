<?php

namespace App\Controller\FrontApp;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/front/app/home", name="app_front_home")
     * @param BookRepository $repository
     * @return  Response
     */
    public function index(BookRepository $repository): Response
    {
        $latestBooks = $repository->findAll();
        return $this->render('front_app/home/index.html.twig', [
            'controller_name' => 'HomeController',
            'latestBooks' => $latestBooks
        ]);
    }
}
