<?php
namespace GftHint\Infrastructure\Shared;
use GftHint\Core\User\Service\AccountService;
use GftHint\Core\User\Service\UserService;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface ServiceProviderInterface
{
	/**
	 * @return UserService
	 */
	public function getUserService();

	/**
	 * @return AccountService
	 */
	public function getAccountService();
} 