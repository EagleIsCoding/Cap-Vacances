<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mon-compte')]
class AccountController extends AbstractController
{
    /**
     * Affiche le profil et les réservations de l'utilisateur
     */
    #[Route('/', name: 'app_account_index')]
    public function index(ReservationRepository $resRepo, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $client = $em->getRepository(Client::class)->find($user->getId());

        $reservations = $resRepo->findBy(['client' => $user->getId()]);
        return $this->render('account/index.html.twig', [
            'client'       => $client,
            'reservations' => $reservations,
        ]);
    }

    /**
     * Permet de modifier les informations personnelles (Nom, Prénom, Rue)
     */
    #[Route('/modifier', name: 'app_account_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $client = $em->getRepository(Client::class)->find($user->getId());

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();
            
            $this->addFlash('success', 'Vos informations de profil ont été mises à jour !');
            return $this->redirectToRoute('app_account_index');
        }

        return $this->render('account/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    } 
}