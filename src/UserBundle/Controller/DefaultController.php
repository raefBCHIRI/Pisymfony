<?php

namespace UserBundle\Controller;

use http\Env\Request;
use ProductBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{

    /**
     * @Route("/homee")
     */
    public function indexAction()
    {
        $produits = $this->getDoctrine()->getRepository(\ProductBundle\Entity\Produit::class)->findAll();
        $a=1;
        $membre=$this->container->get('security.token_storage')->getToken()->getUser();
        if( $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))

            return $this->render('@Product/Admin/afficheProduitAdmin.html.twig', array('produits' => $resultt));
        else if(
        $this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))
            return $this->render('@Product/Client/afficheProduit.html.twig', array('produits' => $produits));
        else
            return $this->render('@Product/Client/afficheProduit.html.twig',array('a'=>$a));
    }
}
