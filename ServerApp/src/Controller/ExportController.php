<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExportController extends AbstractController
{
    /**
     * @Route("/api/export/getAllExports", name="getExports")
     */
    public function getExports()
    {
        $exports = $this->getAllExports();
        return $exports;
    }

    private function getAllExports()
    {
        $exports = $this->getDoctrine()
            ->getRepository('App:Export')
            ->findAll();

        $response = new JsonResponse();
        $response->setData($exports);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/export/getExports/{localId}/{dateFrom}/{dateTo}", name="getExportsByLocalAndDates")
     */
    public function getExportsByLocalAndDates($localId, $dateFrom, $dateTo)
    {
        $exports = $this->getDoctrine()
            ->getRepository('App:Export')
            ->findByLocalAndDateFromAndDateTo($localId, $dateFrom, $dateTo);

        $response = new JsonResponse();
        $response->setData($exports);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
