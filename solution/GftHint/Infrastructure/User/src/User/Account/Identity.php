<?php
namespace GftHint\Infrastructure\User\Account;
use GftHint\Core\User\Entity\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Identity
{
	private $user;

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
	}
}