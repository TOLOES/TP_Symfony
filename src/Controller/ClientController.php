<?php

// src/Controller/ClientController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController
{

    public function info(string $prenom): Response
    {
        if (substr($prenom, -1) === '-' || $prenom[0] === '-' || preg_match('/\d/', $prenom)) {
            return new Response("Le prénom ne peut pas commencer ou se terminer par un tiret et ne doit pas contenir de chiffres.");
        }

        return new Response("Prénom : " . htmlspecialchars($prenom));
    }
}
