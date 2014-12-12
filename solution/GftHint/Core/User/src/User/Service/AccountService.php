<?php
namespace GftHint\Core\User\Service;
use GftHint\Core\User\Entity\User;
use GftHint\Core\User\Interfaces\AccountManagerInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AccountService 
{
	private $manager;

	public function __construct(AccountManagerInterface $manager)
	{
		$this->manager = $manager;
	}

	/**
	 * @var User|null
	 */
	public function getUser()
	{
		return $this->manager->getUser();
	}

	public function login($email, $password)
	{
		$this->manager->login($email, $password);
	}

	public function logout()
	{
		$this->manager->logout();
	}
} 