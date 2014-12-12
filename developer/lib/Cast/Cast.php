<?php
namespace Developer\Cast;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Cast 
{
	/**
	 * @param $value
	 * @return int|null
	 * @throws CastException
	 */
	public static function int($value)
	{
		if (is_int($value))
		{
			return $value;
		}

		if (self::isEmpty($value))
		{
			return null;
		}

		if (!ctype_digit($value))
		{
			throw new CastException('Cannot convert non-numeric type to int');
		}

		return (int) $value;
	}

	/**
	 * @param $value
	 * @return float|null
	 * @throws CastException
	 */
	public static function float($value)
	{
		if (is_float($value) || is_int($value))
		{
			return (float)$value;
		}

		if (self::isEmpty($value))
		{
			return null;
		}

		if (substr_count($value, '.') > 1)
		{
			throw new CastException('Cannot convert value to float');
		}

		$i = str_replace('.', '', $value);

		if (!ctype_digit($i))
		{
			throw new CastException('Cannot convert non-numeric type to float');
		}

		return (float) $value;
	}

	/**
	 * @param $value
	 * @return null|bool
	 * @throws CastException
	 */
	public static function bool($value)
	{
		if (is_bool($value))
		{
			return $value;
		}

		if (self::isEmpty($value))
		{
			return null;
		}

		throw new CastException('Value must be boolean');
	}

	/**
	 * @param $value
	 * @return null|string
	 * @throws CastException
	 */
	public static function string($value)
	{
		if (is_string($value))
		{
			return $value;
		}

		if ($value === null)
		{
			return null;
		}

		if (!is_scalar($value))
		{
			throw new CastException('Only scalar types can be converted to string');
		}

		return (string) $value;
	}


	public static function isEmpty($value)
	{
		return $value === '' || $value === null;
	}

} 