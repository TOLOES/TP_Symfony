<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Routing\RouterInterface;
use App\Controller\ClientController;

class OpenCloseKernelControllerListener
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // Si le contrôleur n'est pas un tableau ou un objet, on ne fait rien
        if (!is_array($controller)) {
            return;
        }

        $routeName = $event->getRequest()->attributes->get('_route');
        $route = $this->router->getRouteCollection()->get($routeName);
        $options = $route->getOption('ouverture');

        [$heureOuverture, $heureFermeture] = explode('-', $options);
        $heureActuelle = (int) date('G');

        if ($heureActuelle < $heureOuverture || $heureActuelle > $heureFermeture) {
            $event->setController([new ClientController(), 'ferme']);
        }
    }
}
