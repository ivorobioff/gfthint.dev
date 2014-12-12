<?php
namespace GftHint\Di\Web;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ServiceProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Web'
				],
			],
		];
	}

	public function getServiceConfig()
	{
		return [
			'invokables' => [
				'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService'
			],
			'factories' => [
				'AccountService' => 'GftHint\Di\Web\AccountServiceFactory',
				'UserService' => 'GftHint\Di\Web\UserServiceFactory',
			],
		];
	}
}