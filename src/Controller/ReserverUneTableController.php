<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserverUneTableController extends AbstractController
{
    #[Route('/reserver/une/table', name: 'app_reserver_une_table')]
    public function index(): Response
    {
        return $this->render('reserver_une_table/index.html.twig', [
            'controller_name' => 'ReserverUneTableController',
        ]);
    }
}
