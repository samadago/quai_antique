<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;


class ReservationController extends AbstractController

{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(ReservationRepository $reservationRepository): Response
    {

        $reservations = $reservationRepository->findAll();


        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route("/reservations/add", name: "reservation_add")]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {

        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('reservation_edit', ['id' => $reservation->getId()]));
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route("/reservations/{id}/edit", name: "reservation_edit")]
    public function edit($id, ReservationRepository $repo, Request $request, EntityManagerInterface $entityManager): Response

    {

        $reservation = $repo->find($id);
        if (!$reservation) {
            return $this->redirect($this->generateUrl('plat_add'));
        }

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirect($this->generateUrl('app_reservations'));
        }

        return $this->render('reservation/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }



    #[Route("/reservations/{id}/show", name: "reservation_show")]

    public function show(?Reservation $reservation, Request $request, EntityManagerInterface $entityManager): Response
    {


        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation

        ]);
    }
}
