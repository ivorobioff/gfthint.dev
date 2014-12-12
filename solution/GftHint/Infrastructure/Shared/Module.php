<?php
namespace GftHint\Infrastructure\Shared;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ServiceProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Shared'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'hydrators' => [
				'factories' => [
					'Default' => 'GftHint\Infrastructure\Shared\Hydrator\DefaultHydratorFactory'
				]
			]
		];
	}

	public function getServiceConfig()
	{
		return [
			'factories' => [
				'Zend\Db\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
			]
		];
	}
}