<?php
namespace Developer\DAL\Mapper;
use Developer\DAL\Format\Dictionary;
use Developer\DAL\Format\Vector;
use Zend\Db\Adapter\Driver\ResultInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Result 
{
	private $result;

	public function __construct(ResultInterface $result)
	{
		$this->result = $result;
	}

	public function getResultIterator()
	{
		return $this->result;
	}

	public function toArray()
	{
		return iterator_to_array($this->result);
	}

	public  function toVector($key, $unique = false)
	{
		return new Vector($this->result, $key, $unique);
	}

	public function toDictionary($key1, $key2 = null)
	{
		return new Dictionary($this->result, $key1, $key2);
	}

	public function toArrayObject()
	{
		return new \ArrayObject($this->toArray());
	}
} 