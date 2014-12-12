<?php
namespace GftHint\Web\Shared\Hydrator;
use Developer\Hydrator\HydratorManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class HydratorManagerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('Config');
		$config = $config['admin_hydrators'];

		return new HydratorManager(new Config($config));
	}
}