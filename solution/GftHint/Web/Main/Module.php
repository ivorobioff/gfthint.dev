<?php
namespace GftHint\Web\Main;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ControllerProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Main'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'router' => [
				'routes' => [
					'default' => [
						'type' => 'literal',
						'options' => [
							'route' => '/',
							'defaults' => [
								'controller' => 'Main\Default',
								'action' => 'index'
							]
						]
					]
				]
			],

			'view_manager' => [
				'template_path_stack' => [
					'main' => __DIR__.'/view',
				],
			]
		];
	}

	public function getControllerConfig()
	{
		return [
			'invokables' => [
				'Main\Default' => 'GftHint\Web\Main\Controller\DefaultController'
			]
		];
	}
}