<?php
namespace GftHint\Infrastructure\User\Account;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Password
{
	public static function hash($password)
	{
		return md5($password);
	}
} 