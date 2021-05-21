<?php

namespace App\Controller;

use App\Entity\Recette;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $arrRec = $this->getDoctrine()->getManager()->getRepository(Recette::class)->findAllJoinUser();
        $r0 = $arrRec[0];
        $r1 = $arrRec[1];
        $r2 = $arrRec[2];
        $arrRec = array('r1' => $r0,'r2' => $r1, 'r3' => $r2);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'recettes' => $arrRec

        ]);
    }
}
