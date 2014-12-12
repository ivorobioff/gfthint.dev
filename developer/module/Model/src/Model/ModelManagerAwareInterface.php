<?php
namespace Developer\Model;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface ModelManagerAwareInterface
{
	/**
	 * @param ModelManager $manager
	 */
	public function setModelManager(ModelManager $manager);

	/**
	 * @return ModelManager
	 */
	public function getModelManager();
} 