<?php
namespace Developer\DAL\Format;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class MapIterator extends \IteratorIterator
{
	private $valueMapper;
	private $keyMapper;

	public function __construct(\Traversable $iterator, callable $valueMapper = null, callable $keyMapper = null)
	{
		parent::__construct($iterator);

		$this->valueMapper = $valueMapper;
		$this->keyMapper = $keyMapper;
	}

	public function current()
	{
		$value = parent::current();

		if ($this->valueMapper === null)
		{
			return $value;
		}

		return call_user_func_array($this->valueMapper, [$value]);
	}

	public function key()
	{
		$key = parent::key();
		$value = parent::current();

		if ($this->keyMapper === null)
		{
			return $key;
		}

		return call_user_func_array($this->keyMapper, [$value]);
	}
} 