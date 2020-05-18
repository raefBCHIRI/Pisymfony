<?php

namespace UserBundle\Controller;
use ProductBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/homee")
     */
    public function indexAction(Request $request)


    {



        $produits = $this->getDoctrine()->getRepository(\ProductBundle\Entity\Produit::class)->findAll();
        $paginator = $this->get('knp_paginator');
        $resultt = $paginator->paginate(
            $produits,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)

        );
        $a=1;
        $membre=$this->container->get('security.token_storage')->getToken()->getUser();
        if( $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))

            return $this->render('@Product/Admin/afficheProduitAdmin.html.twig', array('produits' => $produits));
        else if(
        $this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))
            return $this->render('@Product/Client/afficheProduit.html.twig',array('produits' => $resultt));

        else
            return $this->render('@Product/Client/afficheProduit.html.twig',array('a'=>$a));
    }
}
