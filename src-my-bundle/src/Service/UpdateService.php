<?php

namespace Cerad\MyBundle\Service;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class UpdateService implements ServiceSubscriberInterface
{
  //private ContainerInterface $container;

  public function __construct(private ContainerInterface $container)
  {
    
  }
  ///public function setContainer(ContainerInterface $container)
  //{
  //  $this->container = $container; //dump($container);
  //}
  public function doit()
  {
    $router = $this->container->get('router');
    dump(get_class($router));
  }
  public static function getSubscribedServices(): array
  {//dd('getSubServices');
      return [
          'router' => RouterInterface::class,
          'request_stack' => RequestStack::class,
      ];
  }
}