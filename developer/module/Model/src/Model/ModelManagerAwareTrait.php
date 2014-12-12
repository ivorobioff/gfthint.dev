<?php
namespace Developer\Model;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
trait ModelManagerAwareTrait
{
	private $modelManager;

	/**
	 * @return ModelManager
	 */
	public function getModelManager()
	{
		return $this->modelManager;
	}

	public function setModelManager(ModelManager $manager)
	{
		$this->modelManager = $manager;
	}
} 