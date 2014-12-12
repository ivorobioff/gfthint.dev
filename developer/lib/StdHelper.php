<?php
namespace Developer;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class StdHelper 
{
	/**
	 * @param array|\ArrayAccess $arr
	 * @param $key
	 * @param null $default
	 * @throws \RuntimeException
	 * @return mixed
	 */
	public static function valueOrDefault($arr, $key, $default = null)
	{
		if (!is_array($arr) && !$arr instanceof \ArrayAccess)
		{
			throw new \RuntimeException('$arr must be array or ArrayAccess');
		}

		if ($arr instanceof \ArrayAccess)
		{
			if (!$arr->offsetExists($key))
			{
				return $default;
			}
		}
		else
		{
			if (!array_key_exists($key, $arr))
			{
				return $default;
			}
		}

		return $arr[$key];
	}
}