<?php
namespace GftHint\Web\Shared;
use GftHint\Web\Shared\Event\TemplateInjector;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface,
	ConfigProviderInterface,
	ViewHelperProviderInterface,
	BootstrapListenerInterface,
	ServiceProviderInterface
{
	public function getAutoloaderConfig()
	{
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/Shared'
				],
			],
		];
	}

	public function getConfig()
	{
		return [
			'router' => [
				'routes' => [
					'direct' => [
						'type' => 'segment',
						'options' => [
							'route' => '/:module/:controller/:action',
							'constraints' => [
								'module' => '[a-zA-Z][a-zA-Z0-9_-]+',
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]+',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
							]
						]
					],
				]
			],

			'view_manager' => [
				'display_not_found_reason' => true,
				'display_exceptions' => true,
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				'doctype' => 'HTML5',

				'template_map' => [
					'error/404' => __DIR__ . '/view/error/404.phtml',
					'error/index' => __DIR__ . '/view/error/index.phtml',
					'layout/layout' => __DIR__ . '/view/layout/default.phtml'
				],

				'template_path_stack' => [
					'shared' =>  __DIR__.'/view',
				],

				'strategies' => [
					'ViewJsonStrategy'
				]
			],

			'models' => [
				'options' => [
					'namespace_prefix' => 'GftHint\Admin'
				]
			],

			'admin_hydrators' => [
				'factories' => [
					'Default' => 'GftHint\Web\Shared\Hydrator\DefaultHydratorFactory'
				]
			]
		];
	}

	public function getViewHelperConfig()
	{
		return [
			//
		];
	}

	/**
	 * @param EventInterface|MvcEvent $event
	 * @return array|void
	 */
	public function onBootstrap(EventInterface $event)
	{
		$eventManager = $event->getApplication()->getEventManager();

		$eventManager->getSharedManager()
			->attach(
				'Zend\Stdlib\DispatchableInterface',
				MvcEvent::EVENT_DISPATCH,
				new TemplateInjector(),
				-80
			);


		$eventManager->attach(MvcEvent::EVENT_ROUTE, function(MvcEvent $event){
			$match = $event->getRouteMatch();
			$module = $match->getParam('module');
			if (!$module) return ;

			$controller = $match->getParam('controller');
			if (!$controller) return ;

			$controller = $module.'\\'.$controller;
			$match->setParam('controller', $controller);
		});
	}

	public function getServiceConfig()
	{
		return [
			'factories' => [
				'AdminHydratorManager' => 'GftHint\Web\Shared\Hydrator\HydratorManagerFactory'
			]
		];
	}
}