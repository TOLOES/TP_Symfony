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

        if (!is_array($controller)) {
            return;
        }

        $routeName = $event->getRequest()->attributes->get('_route');

        // Vérifiez si le nom de la route est non null
        if ($routeName) {
            $route = $this->router->getRouteCollection()->get($routeName);

            if ($route && $route->hasOption('ouverture')) {
                $options = $route->getOption('ouverture');
                $optionsArray = explode('-', $options);

                if (count($optionsArray) === 2) {
                    [$heureOuverture, $heureFermeture] = $optionsArray;
                    $heureActuelle = (int) date('G');

                    if ($heureActuelle < $heureOuverture || $heureActuelle > $heureFermeture) {
                        $event->setController([new ClientController(), 'ferme']);
                    }
                } else {
                    throw new \Exception("L'option ouverture doit être de la forme '8-17'");
                }
            }
        }
    }
}
