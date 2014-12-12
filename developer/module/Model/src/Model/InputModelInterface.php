<?php
namespace Developer\Model;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface InputModelInterface 
{
	public function setInputData(array $data);
	public function getInputData();

	public function setQueryData(array $data);
	public function getQueryData();

	public function validate();

	public function setInputFilter(InputFilterInterface $inputFilter);

	/**
	 * @return InputFilterInterface
	 */
	public function getInputFilter();
	public function toArray();
} 