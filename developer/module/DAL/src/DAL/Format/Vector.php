<?php
namespace Developer\DAL\Format;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Vector extends \ArrayObject
{
	public function __construct(\Traversable $data, $key, $unique = false)
	{
		$mapIterator = new MapIterator($data, function($value) use ($key){
			return $value[$key];
		});

		$result = iterator_to_array($mapIterator);

		if ($unique)
		{
			$result = array_unique($result);
		}

		parent::__construct($result);
	}
} 