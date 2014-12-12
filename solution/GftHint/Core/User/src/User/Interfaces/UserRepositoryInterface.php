<?php
namespace GftHint\Core\User\Interfaces;
use GftHint\Core\User\Entity\User;
use GftHint\Core\User\Entity\UserFilter;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface UserRepositoryInterface 
{
	/**
	 * @param UserFilter $filter
	 * @return User
	 */
	public function loadByFilter(UserFilter $filter);
} 