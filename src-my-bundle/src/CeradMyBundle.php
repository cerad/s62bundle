<?php

namespace Cerad\MyBundle;

use Cerad\MyBundle\Command\MyBundleCommand;
use Cerad\MyBundle\Service\UpdateService;
use Cerad\MyBundle\Subscriber\ExceptionSubscriber;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\RegisterServiceSubscribersPass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CeradMyBundle extends AbstractBundle implements CompilerPassInterface
{
  const pageSizes = ['A0', 'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'B0', 'B1', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'C5E', 'Comm10E', 'DLE', 'Executive', 'Folio', 'Ledger', 'Legal', 'Letter', 'Tabloid'];
  const PROVIDER_PDF_ROCKET = 'pdfrocket';

  const KEY_PROVIDER = 'provider';
  const KEY_TIMEOUT = 'timeout';
  const KEY_APIKEY = 'apikey';
  const KEY_DEFAULT_OPTIONS = 'default_options';

  const OPTION_DPI = 'dpi';
  const OPTION_SHRINKING = 'shrinking';
  const OPTION_IMAGE_QUALITY = 'image_quality';
  const OPTION_PAGE_SIZE = 'page_size';
  const OPTION_ZOOM = 'zoom';
  const OPTION_JS_DELAY = 'js_delay';

  public function configure(DefinitionConfigurator $definition): void
  {
    $definition->rootNode()
      ->children()
        ->enumNode(self::KEY_PROVIDER)->values([self::PROVIDER_PDF_ROCKET])->defaultValue(self::PROVIDER_PDF_ROCKET)->end()
        ->integerNode(self::KEY_TIMEOUT)->defaultValue(20)->end()
        ->scalarNode(self::KEY_APIKEY)->isRequired()->end()
        ->arrayNode(self::KEY_DEFAULT_OPTIONS)
            ->children()
                ->integerNode(self::OPTION_DPI)->end()
                ->floatNode(self::OPTION_ZOOM)->end()
                ->integerNode(self::OPTION_JS_DELAY)->end()
                ->booleanNode(self::OPTION_SHRINKING)->defaultTrue()->end()
                ->integerNode(self::OPTION_IMAGE_QUALITY)->end()
                ->enumNode(self::OPTION_PAGE_SIZE)->values(self::pageSizes)->end()
            ->end()
        ->end()
    ->end();
  }
  public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
  {
    $container->import('../config/services.yaml');

    //$builder->register(ExceptionSubscriber::class)
      //->setClass(ExceptionSubscriber::class)
      //->addTag('kernel.event_subscriber');
  }
  public function build(ContainerBuilder $container): void
  {
      $container->addCompilerPass($this);
      //$container->addCompilerPass(new RegisterServiceSubscribersPass());
  }
  public function process(ContainerBuilder $container)
  {
    $container->register(UpdateService::class)
      ->setClass(UpdateService::class)
		  ->addTag('container.service_subscriber')
      ->addArgument(new Reference(PsrContainerInterface::class))
      //->addMethodCall('setContainer',[])
    ;
    $container->register(MyBundleCommand::class)
      ->setClass(MyBundleCommand::class)
      ->addTag('console.command')
      ->addArgument(new Reference(UpdateService::class))
      ;
    $container->register(ExceptionSubscriber::class)
      ->setClass(ExceptionSubscriber::class)
      ->addTag('kernel.event_subscriber');

  }
}