<?php
namespace GftHint\Web\Shared\Event;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class TemplateInjector 
{
	public function __invoke(MvcEvent $event)
	{
		$model = $event->getResult();

		if (!$model instanceof ViewModel)
		{
			return;
		}

		$controller = $event->getTarget();

		if ($model->getTemplate())
		{
			return ;
		}

		if (!is_object($controller))
		{
			return;
		}

		$namespace = explode('\\', ltrim(get_class($controller), '\\'));

		$controllerClass = array_pop($namespace);
		array_pop($namespace);
		array_shift($namespace);
		array_shift($namespace);
		$moduleName = implode('/', $namespace);

		$controller = substr($controllerClass, 0, strlen($controllerClass) - strlen('Controller'));
		$action = $event->getRouteMatch()->getParam('action');

		$filter = new CamelCaseToDash();

		$model->setTemplate(
			strtolower(
				$filter->filter($moduleName).'/'.$filter->filter($controller).'/'.$filter->filter($action)
			)
		);
	}
} 