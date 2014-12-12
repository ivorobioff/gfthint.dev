<?php
namespace GftHint\Web\Shared\Hydrator;
use Developer\Hydrator\EntityHydrator;
use Developer\Hydrator\HydratorFactory;
use Developer\Hydrator\HydratorManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\AbstractHydrator;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DefaultHydratorFactory extends HydratorFactory
{
	/**
	 * @param ServiceLocatorInterface|HydratorManager $serviceLocator
	 * @param array $options
	 * @return AbstractHydrator
	 */
	protected function createHydrator(ServiceLocatorInterface $serviceLocator, array $options)
	{
		return new EntityHydrator(false);
	}
}