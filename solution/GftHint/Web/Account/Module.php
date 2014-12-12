<?php
namespace GftHint\Web\Account;
use Developer\ChkAccess\Condition;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface,
	ConfigProviderInterface,
	ControllerProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Account'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'view_manager' => [
				'template_path_stack' => [
					'account' => __DIR__.'/view',
				],
			],

			'access' => [
				'strategies' => [
					'authentication' => [
						'priority' => 1,
						'class' => 'GftHint\Web\Account\Access\AuthStrategy',
						'default_pass_condition' => Condition::POSITIVE,

						'overrides' => [
							[
								'controller' => 'Account\Access',
								'pass_condition' => Condition::NEGATIVE
							]
						]
					]
				]
			]
		];
	}

	public function getControllerConfig()
	{
		return [
			'invokables' => [
				'Account\Access' => 'GftHint\Web\Account\Controller\AccessController'
			]
		];
	}
}