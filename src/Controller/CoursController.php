<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Inscription;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CoursController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/cours", name="cours")
     */
    public function index(): Response
    {
        $arrCours = $this->getDoctrine()->getManager()->getRepository(Cours::class)->findAllJoinUser(new \DateTime());

        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
            'cours' => $arrCours
        ]);
    }

    /**
     * @Route("/cour/{id}", name="cour" , methods={"GET","POST"})
     */
    public function vue_cours($id, Request $request): Response
    {
        //dd($_POST);
        $arrCours = $this->getDoctrine()->getManager()->getRepository(Cours::class)->findOneByIdJoinUser($id);
        $user = $this->security->getUser();
        //dd($user->getUsername());

        if ($user == null){
            $status = -1;
        } else {
            $inscription = $this->getDoctrine()->getManager()->getRepository(Inscription::class)->findOneByUserName($user->getUsername(), $id);
            if ($inscription){
                $status = 0;
            } else {
                $status = 1;
            }
        }

        return $this->render('cours/vue.html.twig', [
            'controller_name' => 'CoursController',
            'cour' => $arrCours,
            'status' => $status
        ]);
    }

    /**
     * @Route("/cours/ins/{id}", name="ins" , methods={"GET","POST"})
     */
    public function ins($id, Request $request): Response
    {
        $mailUser = $this->security->getUser();
        if ($mailUser == null) {
            return $this->redirect('/cour/'.$id);
        } else {
            $mailUser = $mailUser->getUsername();
        }
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email'=>$mailUser));
        $cours = $this->getDoctrine()->getManager()->getRepository(Cours::class)->findOneBy(array('id'=>$id));
        $entityManager = $this->getDoctrine()->getManager();
        $ins = new Inscription();
        $ins->setUser($user);
        $ins->setCours($cours);
        $entityManager->persist($ins);
        $entityManager->flush();
        $cours->setNbParticipants($cours->getNbParticipants()-1);
        $entityManager->flush();


        return $this->redirect('/cour/'.$id);
    }
    /**
     * @Route("/cours/des/{id}", name="des" , methods={"GET","POST"})
     */
    public function des($id, Request $request): Response
    {
        $mailUser = $this->security->getUser();
        if ($mailUser == null) {
            return $this->redirect('/cour/'.$id);
        } else {
            $mailUser = $mailUser->getUsername();
        }

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email'=>$mailUser));
        $cours = $this->getDoctrine()->getManager()->getRepository(Cours::class)->findOneBy(array('id'=>$id));

        $ins = $this->getDoctrine()->getManager()->getRepository(Inscription::class)->findOneBy(array('user'=> $user->getId(), 'cours' => $cours->getId()));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ins);
        $entityManager->flush();

        if($ins){
            $cours->setNbParticipants($cours->getNbParticipants()+1);
            $entityManager->flush();
        }


        return $this->redirect('/cour/'.$id);
    }

}
