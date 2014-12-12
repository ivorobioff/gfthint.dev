<?php
namespace GftHint\Infrastructure\User;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/User'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'mappers' => [
				'User' => [
					'table' => 'users'
				]
			],

			'repositories' => [
				'invokables' => [
					'User' => 'GftHint\Infrastructure\User\UserRepository'
				]
			],

			'hydrators' => [
				'factories' => [
					'User' => 'GftHint\Infrastructure\User\UserHydratorFactory'
				]
			]
		];
	}
}