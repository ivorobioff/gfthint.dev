<?php
namespace GftHint\Di\Web;
use GftHint\Core\User\Interfaces\UserRepositoryInterface;
use GftHint\Core\User\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		/**
		 * @var UserRepositoryInterface $repository
		 */
		$repository = $serviceLocator->get('RepositoryManager')->get('User');

		return  new UserService($repository);
	}
}