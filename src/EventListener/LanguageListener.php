<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LanguageListener implements EventSubscriberInterface

{
        public function onKernelRequest(RequestEvent $event)

        {

            $request = $event->getRequest();

            $preferedLanguage = $request->getPreferredLanguage();

            $request->setLocale($preferedLanguage);

        }

    public static function getSubscribedEvents()
    {
        return [
           KernelEvents::REQUEST => [['onKernelRequest', 20]]
        ];
    }
}