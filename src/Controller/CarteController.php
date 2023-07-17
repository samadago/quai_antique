<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategoryRepository;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories  = $categoryRepository->findAll();

        return $this->render('carte/carte.html.twig', [
            'categories' => $categories,
        ]);
    }
}
