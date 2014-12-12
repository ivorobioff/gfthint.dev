<?php
namespace GftHint\Core\Gift;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Module implements AutoloaderProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Gift'
				],
			],
		];
	}
} 