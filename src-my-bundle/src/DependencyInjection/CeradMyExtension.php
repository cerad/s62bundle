<?php

namespace Cerad\MyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class CeradMyExtension extends Extension
{
  public function load(array $configs, ContainerBuilder $container)
  {
    //dd('DI Load');
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);
  }
}