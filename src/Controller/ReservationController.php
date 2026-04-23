<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Studio;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

final class ReservationController extends AbstractController
{

    /* 
        * Permet de réserver un studio
        * Vérifie les conflits de réservation avant de persister
    */
    #[Route('/reserver/{num_studio}', name: 'app_reservation_new')]
    public function reserve(
        #[MapEntity(mapping: ['num_studio' => 'id'])] Studio $studio,
        Request $request,
        EntityManagerInterface $em,
        ReservationRepository $resRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $reservation = new Reservation();
        $reservation->setStudio($studio);
        
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $reservation->setClient($user->getClient());
        $reservation->setDateReservation(new \DateTime());

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $debut = $reservation->getDateDebutReservation();
            $fin = $reservation->getDateFinReservation();

            $conflit = $resRepo->createQueryBuilder('r')
                ->where('r.studio = :studio')
                ->andWhere('(:debut < r.dateFinReservation) AND (:fin > r.dateDebutReservation)')
                ->setParameter('studio', $studio)
                ->setParameter('debut', $debut)
                ->setParameter('fin', $fin)
                ->getQuery()
                ->getResult();

            if (!empty($conflit)) {
                $this->addFlash('danger', 'Ce studio est déjà réservé pour ces dates. Veuillez en choisir d\'autres.');
            } else {
                $em->persist($reservation);
                $em->flush();

                $this->addFlash('success', 'Votre séjour au studio ' . $studio->getNomStudio() . ' est réservé !');
                return $this->redirectToRoute('app_studio_index');
            }
        }

        $existingReservations = $resRepo->findBy(['studio' => $studio]);
        $disabledDates = [];
        foreach ($existingReservations as $res) {
            $disabledDates[] = [
                'from' => $res->getDateDebutReservation()->format('Y-m-d'),
                'to'   => $res->getDateFinReservation()->format('Y-m-d')
            ];
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
            'studio' => $studio,
            'disabled_dates' => json_encode($disabledDates) 
        ]);
    }
}