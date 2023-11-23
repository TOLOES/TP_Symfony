<?php

// src/Controller/ImageController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImageController extends AbstractController
{
    #[Route('/img/home', name: 'image_home')]
    public function home()
    {
        return $this->render('img/home.html.twig', [
            'title' => 'Site Image',
        ]);
    }
}


