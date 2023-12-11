<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class FermeService
{
    public function réponseFermé(): Response
    {
        return new Response("Nous sommes fermés !");
    }
}
