<?php
namespace Developer\DAL\Mapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class MapperManagerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$manager = new MapperManager();
		$manager->addAbstractFactory(new MapperAbstractFactory());

		return $manager;
	}
}