<?php
namespace Developer\Hydrator;
use Developer\StdHelper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\AbstractHydrator;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class HydratorFactory implements FactoryInterface, MutableCreationOptionsInterface
{
	private $options = [];

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$hydrator = $this->createHydrator($serviceLocator, $this->options);

		if (!$hydrator instanceof AbstractHydrator)
		{
			throw new \RuntimeException('Hydrator must be instance of AbstractHydrator');
		}

		foreach (StdHelper::valueOrDefault($this->options, 'filters', []) as $filter)
		{
			if (!empty($filter['remove']))
			{
				$hydrator->removeFilter($filter['name']);
			}
			else
			{
				$hydrator->addFilter($filter['name'], $filter['filter'], $filter['condition']);
			}
		}

		foreach (StdHelper::valueOrDefault($this->options, 'strategies', []) as $strategy)
		{
			if (!empty($strategy['remove']))
			{
				$hydrator->removeStrategy($strategy['name']);
			}
			else
			{
				$hydrator->addStrategy($strategy['name'], $strategy['strategy']);
			}
		}

		return $hydrator;
	}

	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param array $options
	 * @return AbstractHydrator
	 */
	abstract protected function createHydrator(ServiceLocatorInterface $serviceLocator, array $options);

	public function setCreationOptions(array $options)
	{
		$this->options = $options;
	}
}