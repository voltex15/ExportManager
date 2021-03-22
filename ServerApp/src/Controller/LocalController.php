<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocalController extends AbstractController
{
    /**
     * @Route("/api/local/getLocals", name="getLocals")
     */
    public function getLocals()
    {
        $locals = $this->getDoctrine()
            ->getRepository('App:Local')
            ->findAll();

        $response = new JsonResponse();
        $response->setData($locals);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
