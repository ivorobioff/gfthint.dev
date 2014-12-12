<?php
namespace Developer\DAL\Format;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Dictionary extends \ArrayObject
{
	public function __construct(\Traversable $iterator, $key1, $key2 = null)
	{
		$valueMapper = null;

		if ($key2 !== null)
		{
			$valueMapper = function($value) use ($key2){
				return $value[$key2];
			};
		}

		$mIterator = new MapIterator($iterator, $valueMapper,
			function($value) use ($key1){
				return $value[$key1];
			}
		);

		parent::__construct(iterator_to_array($mIterator));
	}
}