<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;



class PlatController extends AbstractController
{
    #[Route('/admin/plats', name: 'app_plats')]
    public function index(PlatRepository $platRepository): Response
    {

        $plats = $platRepository->findAll();

        return $this->render('plat/index.html.twig', [
            'plats' => $plats
        ]);
    }


    #[Route("/admin/plat/add", name: "plat_add")]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();

        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('plat_edit', ['id' => $plat->getId()]));
        }

        return $this->render('plat/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/admin/plat/{id}/edit", name: "plat_edit",)]
    public function edit($id, PlatRepository $platRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        $plat = $platRepository->find($id);
        if (!$plat) {
            return $this->redirect($this->generateUrl('plat_add'));
        }

        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirect($this->generateUrl('plat_edit', ['id' => $plat->getId()]));
        }

        return $this->render('plat/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route("/admin/plat/{id}/show", name: "plat_show")]

    public function show(?Plat $plat, Request $request, EntityManagerInterface $entityManager): Response
    {


        return $this->render('plat/show.html.twig', [
            'plat' => $plat

        ]);
    }
}
