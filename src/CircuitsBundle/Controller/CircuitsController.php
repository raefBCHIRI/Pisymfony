<?php

namespace CircuitsBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CircuitsController extends Controller
{
    public function getCircuitsAction()
    {
        return $this->render('@Circuits/Circuits/get_circuits.html.twig');
    }

}
