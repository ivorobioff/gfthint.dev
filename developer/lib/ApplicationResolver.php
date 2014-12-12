<?php
namespace Developer;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ApplicationResolver 
{
	static private $environment;

	static public function setEnvironmentName($name)
	{
		self::$environment = $name;
	}

	static public function is($name)
	{
		return self::$environment == $name;
	}

	static public function getEnvironmentName()
	{
		return self::$environment;
	}
} 