<?php

namespace Cerad\MyBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
        //$this->logger = new LoggerService();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['logException', 0],
        ];
    }

    public function logException(ResponseEvent|ExceptionEvent $event): void
    { 
       dd($event);
    }
  }