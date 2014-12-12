<?php
namespace GftHint\Infrastructure\User;
use GftHint\Infrastructure\Shared\Hydrator\DefaultHydratorFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\AbstractHydrator;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserHydratorFactory extends DefaultHydratorFactory
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param array $options
	 * @return AbstractHydrator
	 */
	protected function createHydrator(ServiceLocatorInterface $serviceLocator, array $options)
	{
		$hydrator = parent::createHydrator($serviceLocator, $options);

		$hydrator->addFilter('friends', new MethodMatchFilter('getFriends'), FilterComposite::CONDITION_AND);
		$hydrator->addFilter('gifts', new MethodMatchFilter('getGifts'), FilterComposite::CONDITION_AND);

		return $hydrator;
	}
} 