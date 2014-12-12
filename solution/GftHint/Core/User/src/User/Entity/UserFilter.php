<?php
namespace GftHint\Core\User\Entity;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserFilter 
{
	private $email;
	private $passwordHash;

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setPasswordHash($hash)
	{
		$this->passwordHash = $hash;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPasswordHash()
	{
		return $this->passwordHash;
	}
} 