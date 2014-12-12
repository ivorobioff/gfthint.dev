<?php
namespace Developer\DAL;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements ServiceProviderInterface, AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getServiceConfig()
	{
		return [
			'invokables' => [
				'QueryManager' => 'Developer\DAL\Query\QueryManager',
			],

			'factories' => [
				'MapperManager' => 'Developer\DAL\Mapper\MapperManagerFactory',
				'RepositoryManager' => 'Developer\DAL\Repository\RepositoryManagerFactory',
				'HydratorManager' => 'Developer\DAL\Hydrator\HydratorManagerFactory'
			]
		];
	}
	
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/DAL'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'hydrators' => [
				//
			]
		];
	}
}