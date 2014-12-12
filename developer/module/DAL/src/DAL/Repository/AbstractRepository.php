<?php
namespace Developer\DAL\Repository;
use Developer\DAL\Hydrator\HydratorManagerAwareInterface;
use Developer\DAL\Hydrator\HydratorManagerAwareTrait;
use Developer\DAL\Mapper\MapperManager;
use Developer\DAL\Mapper\MapperManagerAwareInterface;
use Developer\DAL\Query\QueryManager;
use Developer\DAL\Query\QueryManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractRepository implements
	RepositoryInterface,
	ServiceLocatorAwareInterface,
	MapperManagerAwareInterface,
	QueryManagerAwareInterface,
	HydratorManagerAwareInterface
{
	use ServiceLocatorAwareTrait;
	use HydratorManagerAwareTrait;

	/**
	 * @var MapperManager
	 */
	private $mapperManager;
	private $queryManager;


	public function setMapperManager(MapperManager $manager)
	{
		$this->mapperManager = $manager;
	}

	/**
	 * @return MapperManager
	 */
	public function getMapperManager()
	{
		return $this->mapperManager;
	}

	/**
	 * @return QueryManager
	 */
	public function getQueryManager()
	{
		return $this->queryManager;
	}

	public function setQueryManager(QueryManager $manager)
	{
		$this->queryManager = $manager;
	}
} 