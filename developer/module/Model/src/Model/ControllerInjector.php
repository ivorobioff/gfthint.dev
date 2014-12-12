<?php
namespace Developer\Model;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ControllerInjector implements InitializerInterface
{
	/**
	 * @param $instance
	 * @param ServiceLocatorInterface|AbstractPluginManager $controllerManager
	 * @return mixed|void
	 */
	public function initialize($instance, ServiceLocatorInterface $controllerManager)
	{
		$sm = $controllerManager->getServiceLocator();

		if ($instance instanceof ModelManagerAwareInterface)
		{
			/**
			 * @var ModelManager $modelManager
			 */
			$modelManager = $sm->get('ModelManager');
			$instance->setModelManager($modelManager);
		}

		return $instance;
	}
}