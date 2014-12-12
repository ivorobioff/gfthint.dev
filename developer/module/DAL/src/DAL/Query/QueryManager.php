<?php
namespace Developer\DAL\Query;
use Developer\DAL\Mapper\MapperManager;
use Developer\DAL\Mapper\MapperManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class QueryManager implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;

	public function executeQuery(QueryInterface $query)
	{
		if ($query instanceof MapperManagerAwareInterface)
		{
			/**
			 * @var MapperManager $mapperManager
			 */
			$mapperManager = $this->getServiceLocator()->get('MapperManager');
			$query->setMapperManager($mapperManager);
		}

		if ($query instanceof QueryManagerAwareInterface)
		{
			$query->setQueryManager($this);
		}

		return $query->execute();
	}
} 