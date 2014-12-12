<?php
namespace Developer\DAL\Repository;
use Developer\DAL\Hydrator\HydratorManagerAwareInterface;
use Developer\DAL\Mapper\MapperManager;
use Developer\DAL\Mapper\MapperManagerAwareInterface;
use Developer\DAL\Query\QueryManager;
use Developer\DAL\Query\QueryManagerAwareInterface;
use Developer\Hydrator\HydratorManager;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class RepositoryManagerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config')['repositories'];
		$configurator = new Config($config);
		$manager = new RepositoryManager($configurator);

		$manager->addInitializer([$this, 'initializeRepository']);

		return $manager;
	}

	public function initializeRepository(RepositoryInterface $repository, AbstractPluginManager $pluginManager)
	{
		if ($repository instanceof MapperManagerAwareInterface)
		{
			/**
			 * @var MapperManager $mapperManager
			 */
			$mapperManager = $pluginManager->getServiceLocator()->get('MapperManager');
			$repository->setMapperManager($mapperManager);
		}

		if ($repository instanceof QueryManagerAwareInterface)
		{
			/**
			 * @var QueryManager $queryManager
			 */
			$queryManager = $pluginManager->getServiceLocator()->get('QueryManager');
			$repository->setQueryManager($queryManager);
		}

		if ($repository instanceof HydratorManagerAwareInterface)
		{
			/**
			 * @var HydratorManager $hydratorManager
			 */
			$hydratorManager = $pluginManager->getServiceLocator()->get('HydratorManager');
			$repository->setHydratorManager($hydratorManager);
		}
	}
}