<?php
namespace Developer\Model;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ModelManagerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$services = [];
		$options = [];

		if (isset($config['models']['services']))
		{
			$services = $config['models']['services'];
		}

		if (isset($config['models']['options']))
		{
			$options = $config['models']['options'];
		}


		$managerConfig = new Config($services);

		$modelManager = new ModelManager($managerConfig, $options);
		$modelManager->addInitializer(new InputModelInitializer());

		return $modelManager;
	}
}