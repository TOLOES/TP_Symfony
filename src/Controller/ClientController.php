<?php

// src/Controller/ClientController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController
{
    /**
     * @Route("/client/prenom/{prenom}", name="client_info", requirements={"prenom"="[a-zA-Z]+(?:-[a-zA-Z]+)*-*"})
     */
    public function info(string $prenom): Response
    {
        if (substr($prenom, -1) === '-' || $prenom[0] === '-') {
            return new Response("Le prénom ne peut pas commencer ou se terminer par un tiret.");
        }

        return new Response("Prénom : " . htmlspecialchars($prenom));
    }
}
