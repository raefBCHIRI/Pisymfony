<?php

namespace CircuitsBundle\Controller;
use CircuitsBundle\Entity\Circuit;
use CircuitsBundle\Entity\Station;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CircuitsBundle\Form\CircuitType;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

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

    public function getCircuitMobileAction()
    {
        $circuit = $this->getDoctrine()->getManager()
            ->getRepository('CircuitsBundle:Circuit')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuit);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $circuits = $this->getDoctrine()
            ->getManager()
            ->getRepository('CircuitsBundle:Circuit')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuits);
        return new JsonResponse($formatted);
    }

    public function addCircuitMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $circuit = new Circuit();
        $begin = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('begin')]);
        $pause = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('pause')]);
        $end = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('end')]);
        $circuit->setNom($request->get('nom'));
        $circuit->setDepart($begin);
        $circuit->setPause($pause);
        $circuit->setEnd($end);
        $circuit->setDifficulty($request->get('difficulty'));
        $circuit->setDistance($request->get('distance'));
        $em->persist($circuit);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuit);
        return new JsonResponse($formatted);
    }

    public function deleteCircuitMobileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("CircuitsBundle:Circuit")->find($id);
        $em->remove($prod);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prod);
        return new JsonResponse($formatted);
    }

    public function updateCircuitMobileAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $nbegin = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('begin')]);
        $npause = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('pause')]);
        $nend = $this->getDoctrine()->getManager()->getRepository(Station::class)->findOneBy(["nom" => $request->get('end')]);

        $circuit = $em->getRepository(Circuit::class)->find($id);

        $circuit->setNom($request->get('nom'));
        $circuit->setDepart($nbegin);
        $circuit->setPause($npause);
        $circuit->setEnd($nend);
        $circuit->setDifficulty($request->get('difficulty'));
        $circuit->setDistance($request->get('distance'));
        $em->persist($circuit);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuit);
        return new JsonResponse($formatted);
    }
    public function highDistMobileAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('CircuitsBundle:Circuit')->findBy([], ['distance' => 'DESC']);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuit);
        return new JsonResponse($formatted);
    }
    public function lowDistMobileAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('CircuitsBundle:Circuit')->findBy([], ['distance' => 'ASC']);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($circuit);
        return new JsonResponse($formatted);
    }
    public function showUserMobileAction(){
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($user);
        return new JsonResponse($formatted);
    }
}
