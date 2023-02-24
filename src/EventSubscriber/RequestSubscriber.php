<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [RequestEvent::class => ['onRequestEvent']];
    }

    public function onRequestEvent(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $_SERVER['REMOTE_ADDR'] = $request->getClientIp();
    }
}
