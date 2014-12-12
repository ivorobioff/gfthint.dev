<?php
namespace Developer\DAL\Hydrator;
use Developer\Hydrator\HydratorManager;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
trait HydratorManagerAwareTrait 
{
	private $hydratorManager;

	public function setHydratorManager(HydratorManager $manager)
	{
		$this->hydratorManager = $manager;
	}

	/**
	 * @return HydratorManager
	 */
	public function getHydratorManager()
	{
		return $this->hydratorManager;
	}
} 