<?php

// src/Controller/ImageController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;


class ImageController extends AbstractController
{
    #[Route('/img/home', name: 'image_home')]
    public function home()
    {
        return $this->render('img/home.html.twig', [
            'title' => 'Site Image',
        ]);
    }
    #[Route('/img/data/{imageName}', name: 'image_data')]
    public function affiche(string $imageName): Response
    {
        $imagePath = $this->getParameter('kernel.project_dir') . '/images/' . $imageName . '.jpeg';

        if (!file_exists($imagePath)) {
            throw $this->createNotFoundException('L\'image demandée n\'existe pas.');
        }

        $file = new File($imagePath);
        $response = new Response(file_get_contents($imagePath));
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->headers->set('Content-Disposition', 'inline; filename="' . $file->getFilename() . '"');

        return $response;
    }
}


