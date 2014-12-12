<?php
namespace GftHint\Infrastructure\Shared\Hydrator;
use Developer\Hydrator\EntityHydrator;
use Developer\Hydrator\HydratorFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\AbstractHydrator;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DefaultHydratorFactory extends HydratorFactory
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param array $options
	 * @return AbstractHydrator
	 */
	protected function createHydrator(ServiceLocatorInterface $serviceLocator, array $options)
	{
		return new EntityHydrator(false);
	}
}