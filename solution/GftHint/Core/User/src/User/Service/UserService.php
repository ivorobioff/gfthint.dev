<?php
namespace GftHint\Core\User\Service;
use GftHint\Core\User\Entity\User;
use GftHint\Core\User\Entity\UserFilter;
use GftHint\Core\User\Interfaces\UserRepositoryInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserService 
{
	private $repository;

	public function __construct(UserRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param $email
	 * @param $passwordHash
	 * @return User
	 */
	public function getByCredentials($email, $passwordHash)
	{
		$filter = new UserFilter();
		$filter->setEmail($email);
		$filter->setPasswordHash($passwordHash);

		return $this->repository->loadByFilter($filter);
	}
} 