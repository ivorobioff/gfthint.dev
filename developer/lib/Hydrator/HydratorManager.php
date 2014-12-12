<?php
namespace Developer\Hydrator;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\RuntimeException;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 * @method EntityHydrator get($name)
 */
class HydratorManager extends AbstractPluginManager
{
	protected $shareByDefault = false;

	public function validatePlugin($hydrator)
	{
		if (!$hydrator instanceof EntityHydrator)
		{
			throw new RuntimeException('$hydrator must be instance of EntityHydrator');
		}
	}
}