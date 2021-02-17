<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresas;
use App\Entity\User;
use App\Entity\Registro;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
            if($this->isGranted("ROLE_OWNER")){
                return $this->render('user/owner.html.twig');
            }else if ($this->isGranted("ROLE_ADMIN")){
                 return $this->redirectToRoute("empresas_index");
            }else if ($this->isGranted("ROLE_USER")){
                $registro= new Registro();
                $ultimo = $this->getDoctrine()->getRepository(Registro::class)->findBy(['user'=>$this->getUser()->getId()],['id'=>'DESC'],1,0);

                if(isSet($ultimo[0])){
                    if($ultimo[0]->getOutput()===null){
                        $fecha = new \DateTime();
                        $entityManager = $this->getDoctrine()->getManager();
                        $ultimo[0]->setOutput($fecha);
                        $entityManager->persist($ultimo[0]);
                        $entityManager->flush();
                    }else{
                        $fecha = new \DateTime();
                        $entityManager = $this->getDoctrine()->getManager();
                        $registro->setUser($this->getUser());
                        $registro->setInput($fecha);
                        $entityManager->persist($registro);
                        $entityManager->flush();
                    }
                }else{
                    $fecha = new \DateTime();
                    $entityManager = $this->getDoctrine()->getManager();
                    $registro->setUser($this->getUser());
                    $registro->setInput($fecha);
                    $entityManager->persist($registro);
                    $entityManager->flush();
                }

                 return $this->redirectToRoute("user_index");
            }else{
                return $this->redirectToRoute("app_login");
            }
    }
}
