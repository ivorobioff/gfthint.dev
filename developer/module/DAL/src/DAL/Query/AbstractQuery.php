<?php
namespace Developer\DAL\Query;
use Developer\DAL\Mapper\MapperManager;
use Developer\DAL\Mapper\MapperManagerAwareInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractQuery implements QueryInterface,
	MapperManagerAwareInterface,
	QueryManagerAwareInterface
{
	private $mapperManager;
	private $queryManager;

	/**
	 * @return MapperManager
	 */
	public function getMapperManager()
	{
		return $this->mapperManager;
	}

	public function setMapperManager(MapperManager $manager)
	{
		$this->mapperManager = $manager;
	}

	public function setQueryManager(QueryManager $manager)
	{
		$this->queryManager = $manager;
	}

	/**
	 * @return QueryManager
	 */
	public function getQueryManager()
	{
		return $this->queryManager;
	}
}