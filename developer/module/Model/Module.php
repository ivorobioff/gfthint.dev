<?php
namespace Developer\Model;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface,
	ServiceProviderInterface,
	ControllerProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Model'
				],
			],
		];
	}

	public function getControllerConfig()
	{
		return [
			'initializers' => [
				'Developer\Model\ControllerInjector'
			]
		];
	}

	public function getServiceConfig()
	{
		return [
			'factories' => [
				'ModelManager' => 'Developer\Model\ModelManagerFactory',
			]
		];
	}
}