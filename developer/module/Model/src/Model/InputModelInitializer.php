<?php
namespace Developer\Model;
use Zend\Http\PhpEnvironment\Request;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class InputModelInitializer implements InitializerInterface
{
	/**
	 * @param object|InputModelInterface $instance
	 * @param ServiceLocatorInterface|AbstractPluginManager $modelManager
	 * @return object|InputModelInterface
	 */
	public function initialize($instance, ServiceLocatorInterface $modelManager)
	{
		$serviceLocator = $modelManager->getServiceLocator();

		if ($instance instanceof InputModelInterface)
		{
			/**
			 * @var Request $request
			 */
			$request = $serviceLocator->get('Request');

			$instance->setQueryData($request->getQuery()->toArray());
			$instance->setInputData($request->getPost()->toArray());

			$inputFilter = $serviceLocator->get('InputFilterManager')->get('inputfilter');
			$instance->setInputFilter($inputFilter);
		}

		return $instance;
	}
}