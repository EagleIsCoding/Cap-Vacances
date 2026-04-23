<?php

namespace App\Controller;

use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request; 
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commune;

class StudioController extends AbstractController
{

#[Route('', name: 'app_studio_index_root')] 
    #[Route('/studio', name: 'app_studio_index')]
    public function index(Request $request, StudioRepository $studioRepo, EntityManagerInterface $em): Response
    {
        $communeId = $request->query->get('commune');
        
        if ($communeId) {
            $studios = $studioRepo->findByCommune($communeId);
        } else {
            $studios = $studioRepo->findAll();
        }

        $communes = $em->getRepository(Commune::class)->findAll();

        return $this->render('studio/index.html.twig', [
            'studios' => $studios,
            'communes' => $communes,
            'currentCommune' => $communeId
        ]);
    }
}