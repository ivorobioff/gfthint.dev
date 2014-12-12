<?php
namespace Developer\Model;

use Developer\Model\Exceptions\InvalidInputs;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractInputModel implements InputModelInterface
{
	private $inputData;
	private $queryData;
	private $inputFilter;

	public function setInputData(array $data)
	{
		$this->inputData = $data;
	}

	public function setQueryData(array $data)
	{
		$this->queryData = $data;
	}

	public function getInputData()
	{
		return $this->inputData;
	}

	public function getQueryData()
	{
		return $this->queryData;
	}

	protected function populateInputFilter(InputFilterInterface $inputFilter)
	{
		//
	}

	protected function prepareData()
	{
		return $this->getInputData();
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		$this->inputFilter = $this->prepareInputFilter($inputFilter);
	}

	public function getInputFilter()
	{
		if (is_null($this->inputFilter))
		{
			$this->inputFilter = $this->prepareInputFilter(new InputFilter());
		}

		return $this->inputFilter;
	}

	private function prepareInputFilter(InputFilterInterface $inputFilter)
	{
		$this->populateInputFilter($inputFilter);
		$inputFilter->setData($this->prepareData());

		return $inputFilter;
	}

	public function validate()
	{
		if (!$this->getInputFilter()->isValid())
		{
			throw new InvalidInputs($this->getInputFilter()->getMessages());
		}
	}

	public function toArray()
	{
		return $this->getInputFilter()->getValues();
	}

	public function __isset($name)
	{
		if (!$this->getInputFilter()->has($name))
		{
			return false;
		}

		return $this->getInputFilter()->getValue($name) !== null;
	}

	public function __get($name)
	{
		return $this->getInputFilter()->getValue($name);
	}

	public function __set($name, $value)
	{
		throw new \RuntimeException('Read-only property');
	}
}