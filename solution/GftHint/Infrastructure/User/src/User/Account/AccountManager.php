<?php
namespace GftHint\Infrastructure\User\Account;
use GftHint\Core\User\Entity\User;
use GftHint\Core\User\Exception\LoginException;
use GftHint\Core\User\Interfaces\AccountManagerInterface;
use GftHint\Infrastructure\Shared\ServiceProviderInterface;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AccountManager implements AccountManagerInterface
{
	private $authenticationService;
	private $serviceProvider;

	public function __construct(
		AuthenticationServiceInterface $authenticationService,
		ServiceProviderInterface $serviceProvider
	)
	{
		$this->authenticationService = $authenticationService;
		$this->serviceProvider = $serviceProvider;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		if (!$this->authenticationService->hasIdentity())
		{
			return null;
		}

		return $this->authenticationService->getIdentity()->getUser();
	}

	public function login($email, $password)
	{
		$adapter = new Adapter($email, $password, $this->serviceProvider->getUserService());
		$result = $this->authenticationService->authenticate($adapter);

		if (!$result->isValid())
		{
			throw new LoginException($result->getMessages()[$result->getCode()], $result->getCode());
		}
	}

	public function logout()
	{
		$this->authenticationService->clearIdentity();
	}
}