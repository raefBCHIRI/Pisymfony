<?php

namespace CircuitsBundle\Controller;
use CircuitsBundle\Entity\Circuit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CircuitsBundle\Form\CircuitType;

class CircuitsController extends Controller
{
    public function getCircuitsAction()
    {
        $circuits = $this->getDoctrine()->getRepository(\CircuitsBundle\Entity\Circuit::class)->findAll();

        return $this->render('@Circuits/Circuits/get_circuits.html.twig', array('circuits' => $circuits));
    }

    public function createAction(Request $request)
    {

        $c = new Circuit();
        $form = $this->createForm('CircuitsBundle\Form\CircuitType', $c);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            echo "<script> alert(\" Circuit ajouté avec succès \")</script>";
        }

        return $this->render('@Circuits/Circuits/AjouterCircuit.html.twig', array('form' => $form->createView()));
        $this->addFlash("success", "projet creer avec succee");
    }

    public function deleteCircuitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("CircuitsBundle:Circuit")->find($id);
        $em->remove($prod);
        $em->flush();
        return $this->redirectToRoute("get_circuits");

    }
    public function updateCircuitAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository(\CircuitsBundle\Entity\Circuit::class)->find($id);
        $f = $this->createForm(\CircuitsBundle\Form\CircuitType::class, $circuit);

        $f = $f->handleRequest($request);
        if ($f->isValid()) {


            //var_dump($file);





            $em = $this->getDoctrine()->getManager();
            $em->persist($circuit);
            $em->flush();
            return $this->redirectToRoute('get_circuits');
        }


        return $this->render('@Circuits/Circuits/modifierCircuit.html.twig', array('f' => $f->createView()));
    }
}
