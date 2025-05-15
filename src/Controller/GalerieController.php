<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GalerieController extends AbstractController
{
    #[Route('/galerie', name: 'app_galerie')]
    public function index(PhotoRepository $photoRepository): Response
    {
        // Récupérer toutes les photos depuis la base de données
        $photos = $photoRepository->findAll();

        return $this->render('galerie/index.html.twig', [
            'photos' => $photos,
        ]);
    }
}
