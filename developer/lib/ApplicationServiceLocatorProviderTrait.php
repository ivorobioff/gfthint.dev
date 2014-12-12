<?php
namespace Developer;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
trait ApplicationServiceLocatorProviderTrait
{
	/**
	 * @return ServiceLocatorInterface
	 * @throws \RuntimeException
	 */
	public function getApplicationServiceLocator()
	{
		if (!$this instanceof ServiceLocatorAwareInterface)
		{
			throw new \RuntimeException('$this must be instance of ServiceLocatorAwareInterface');
		}

		/**
		 * @var ServiceLocatorAwareInterface $this
		 */
		$pluginManager = $this->getServiceLocator();

		if (!$pluginManager instanceof AbstractPluginManager)
		{
			throw new \RuntimeException('$this must be a plugin of AbstractPluginManager');
		}

		return $pluginManager->getServiceLocator();
	}
} 