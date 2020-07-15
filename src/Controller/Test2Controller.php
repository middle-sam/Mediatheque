<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Test2Controller extends AbstractController
{
    /**
     * @Route("/test2", name="test2")
     */
    public function index()
    {
        return $this->render('test2/index.html.twig', [
            'controller_name' => 'Test2Controller',
        ]);
    }
}
