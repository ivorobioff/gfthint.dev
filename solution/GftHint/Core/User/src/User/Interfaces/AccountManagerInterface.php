<?php
namespace GftHint\Core\User\Interfaces;
use GftHint\Core\User\Entity\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface AccountManagerInterface 
{
	/**
	 * @return User
	 */
	public function getUser();
	public function login($email, $password);
	public function logout();
} 