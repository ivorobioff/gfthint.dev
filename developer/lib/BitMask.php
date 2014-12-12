<?php
namespace Developer;

class BitMask
{
	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function add($item)
	{
		$this->value |=$this->pow($item);
	}

	public function remove($item)
	{
		$this->value ^=$this->pow($item);
	}

	public function has($item)
	{
		return (bool)($this->value & $this->pow($item));
	}

	public function getResult()
	{
		return $this->value;
	}

	private function pow($item)
	{
		return pow(2, $item);
	}
}