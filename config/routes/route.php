<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller\ClientController;

return function (RoutingConfigurator $routes) {
    $routes->add('client_info', '/client/prenom/{prenom}')
        ->controller([ClientController::class, 'info'])
        ->methods(['GET', 'HEAD'])
        ->requirements(['prenom' => '^[a-zA-Z]+(\-[a-zA-Z]+)*$']);
};
