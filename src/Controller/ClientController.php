<?php

// src/Controller/ClientController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

# #[Route('/client')]

class ClientController extends AbstractController
{
    # #[Route('/prenom/{prenom}', name: 'client_info', requirements: ['prenom' => '[a-zA-Z\-]+'])]
    public function info(string $prenom): Response
    {

        return new Response("Prénom : " . htmlspecialchars($prenom));
    }
}

