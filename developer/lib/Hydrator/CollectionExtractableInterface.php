<?php
namespace Developer\Hydrator;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface CollectionExtractableInterface
{
	/**
	 * @param $collection
	 * @return array
	 */
	public function extractCollection($collection);
} 