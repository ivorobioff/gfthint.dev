<?php
namespace Developer\DAL\Repository;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\RuntimeException;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class RepositoryManager extends AbstractPluginManager
{
	public function validatePlugin($plugin)
	{
		if (!$plugin instanceof RepositoryInterface)
		{
			throw new RuntimeException('Repository must be instance of AbstractRepository');
		}
	}
}