<?php
namespace GftHint\Infrastructure\Shared\Hydrator\Strategy;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class BooleanStrategy implements StrategyInterface
{
	public function extract($value)
	{
		if (!is_bool($value))
		{
			throw new \RuntimeException('$value is expected to be boolean.');
		}

		return $value === true ? 1 : 0;
	}

	public function hydrate($value)
	{
		if (!in_array($value, [0, 1]))
		{
			throw new \RuntimeException('$value is expected to be 0 or 1.');
		}

		return $value == 1 ? true : false;
	}
}