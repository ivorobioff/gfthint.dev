<?php
namespace Developer\Hydrator;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EntityHydrator extends ClassMethods implements CollectionExtractableInterface
{
	use CollectionExtractableTrait;
} 