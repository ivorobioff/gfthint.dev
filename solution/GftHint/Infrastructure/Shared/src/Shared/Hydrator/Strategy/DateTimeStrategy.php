<?php
namespace GftHint\Infrastructure\Shared\Hydrator\Strategy;
use Developer\Cast\Cast;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DateTimeStrategy implements StrategyInterface
{
	/**
	 * @param \DateTime $value
	 * @return mixed|void
	 * @throws \RuntimeException
	 */
	public function extract($value)
	{
		if ($value === null)
		{
			return null;
		}

		if (!$value instanceof \DateTime)
		{
			throw new \RuntimeException('$value must be instance of \DateTime, something else given');
		}

		return $value->format('Y-m-d H:i:s');
	}

	/**
	 * @param string $value
	 * @return \DateTime
	 */
	public function hydrate($value)
	{
		if (Cast::isEmpty($value))
		{
			return null;
		}

		return new \DateTime($value);
	}
}