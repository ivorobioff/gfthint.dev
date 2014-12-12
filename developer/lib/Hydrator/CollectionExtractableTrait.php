<?php
namespace Developer\Hydrator;
use Zend\Stdlib\Extractor\ExtractionInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
trait CollectionExtractableTrait
{
	public function extractCollection($collection)
	{
		if (!is_array($collection) && !$collection instanceof \Traversable)
		{
			throw new \InvalidArgumentException('$collection must be array or instance of \Traversable');
		}

		if (!$this instanceof ExtractionInterface)
		{
			throw new \InvalidArgumentException('$this must be instance of ExtractionInterface');
		}

		$result = [];

		foreach ($collection as $object)
		{
			$result[] = $this->extract($object);
		}

		return $result;
	}
} 