<?php
namespace GftHint\Infrastructure\User\Account;
use GftHint\Core\User\Service\UserService;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Adapter implements AdapterInterface
{
	private $email;
	private $password;

	/**
	 * @var UserService
	 */
	private $userService;

	public function __construct($email, $password, UserService $userService)
	{
		$this->email = $email;
		$this->password = $password;
		$this->userService = $userService;
	}

	/**
	 * Performs an authentication attempt
	 *
	 * @return \Zend\Authentication\Result
	 * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
	 */
	public function authenticate()
	{
		$user = $this->userService
			->getByCredentials($this->email, Password::hash($this->password));

		if ($user === null)
		{
			return new Result(Result::FAILURE, null, [Result::FAILURE => 'Invalid email or password']);
		}

		$identity = new Identity();
		$identity->setUser($user);

		return new Result(Result::SUCCESS, $identity);
	}
}