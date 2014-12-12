<?php
namespace Developer\DAL\Hydrator;
use Developer\Hydrator\HydratorManager;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface HydratorManagerAwareInterface 
{
	public function setHydratorManager(HydratorManager $manager);
	public function getHydratorManager();
} 