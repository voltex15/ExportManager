<?php

namespace App\Controller;


use App\Entity\Export;
use App\Entity\Local;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/api/test/createExampleData", name="createExampleData")
     */
    public function createExampleDataInDatabase()
    {
        $this->createUsers();
        $this->createLocals();
    }

    /**
     * @Route("/api/test/createExports", name="createExampleExports")
     */
    public function createExampleExports()
    {
        $this->createExports();
    }

    private function createUsers(): void
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('Testowy uzytkownik 1');
        $entityManager->persist($user);
        $entityManager->flush();

        $user = new User();
        $user->setName('Testowy uzytkownik 2');
        $entityManager->persist($user);
        $entityManager->flush();

        $user = new User();
        $user->setName('Testowy uzytkownik 3');
        $entityManager->persist($user);
        $entityManager->flush();
    }

    private function createLocals(): void
    {
        $entityManager = $this->getDoctrine()->getManager();

        $local = new Local();
        $local->setName('Lokal 1');
        $entityManager->persist($local);
        $entityManager->flush();

        $local = new Local();
        $local->setName('Lokal 2');
        $entityManager->persist($local);
        $entityManager->flush();

        $local = new Local();
        $local->setName('Lokal 3');
        $entityManager->persist($local);
        $entityManager->flush();
    }

    private function createExports(): void
    {
        $entityManager = $this->getDoctrine()->getManager();

        $users = $this->getDoctrine()
            ->getRepository('App:User')
            ->findAll();
        shuffle($users);

        $locals = $this->getDoctrine()
            ->getRepository('App:Local')
            ->findAll();
        shuffle($locals);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', "2020-03-22 10:00:00");
        $export = new Export();
        $export->setName('Raport 1');
        $export->setExportDate($date);
        $export->setUser($users[0]);
        $export->setLocal($locals[0]);
        $entityManager->persist($export);
        $entityManager->flush();

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', "2020-03-22 11:00:00");
        $export = new Export();
        $export->setName('Raport 2');
        $export->setExportDate($date);
        $export->setUser($users[1]);
        $export->setLocal($locals[0]);
        $entityManager->persist($export);
        $entityManager->flush();

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', "2020-03-23 10:00:00");
        $export = new Export();
        $export->setName('Raport 3');
        $export->setExportDate($date);
        $export->setUser($users[1]);
        $export->setLocal($locals[2]);
        $entityManager->persist($export);
        $entityManager->flush();

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', "2020-03-24 12:00:00");
        $export = new Export();
        $export->setName('Raport 4');
        $export->setExportDate($date);
        $export->setUser($users[2]);
        $export->setLocal($locals[1]);
        $entityManager->persist($export);
        $entityManager->flush();
    }
}
