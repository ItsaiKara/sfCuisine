<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VueJSController extends AbstractController
{
    /**
     * @Route("/idee", name="vue")
     */
    public function index(): Response
    {
        return $this->render('vue_js/index.html.twig', [
            'controller_name' => 'VueJSController',
        ]);
    }
}
