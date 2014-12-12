<?php
namespace Developer\DAL\Mapper;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class MapperAbstractFactory implements AbstractFactoryInterface
{
	/**
	 * @param ServiceLocatorInterface|AbstractPluginManager $pluginManager
	 * @param string $name
	 * @param string $requestedName
	 * @return bool
	 */
	public function canCreateServiceWithName(ServiceLocatorInterface $pluginManager, $name, $requestedName)
	{
		$config = $pluginManager->getServiceLocator()->get('config')['mappers'];
		return isset($config[$requestedName]);
	}

	/**
	 * @param ServiceLocatorInterface|AbstractPluginManager $pluginManager
	 * @param string $name
	 * @param string $requestedName
	 * @return Mapper
	 */
	public function createServiceWithName(ServiceLocatorInterface $pluginManager, $name, $requestedName)
	{
		$config = $pluginManager->getServiceLocator()->get('config')['mappers'][$requestedName];
		$mapper = new Mapper();

		/**
		 * @var AdapterInterface $adapter
		 */
		$adapter = $pluginManager->getServiceLocator()->get('Zend\Db\Adapter');

		$sql = new Sql($adapter, $config['table']);
		$mapper->setSqlObject($sql);

		return $mapper;
	}
}