<?php
namespace Developer\Validator;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Date extends AbstractValidator
{
	const INVALID        = 'dateInvalid';
	const INVALID_DATE   = 'dateInvalidDate';
	const FALSEFORMAT    = 'dateFalseFormat';

	protected $format = 'Y-m-d H:i:s';

	protected $messageTemplates = array(
		self::INVALID      => "Invalid type given. String, integer, array or DateTime expected",
		self::INVALID_DATE => "The input does not appear to be a valid date",
		self::FALSEFORMAT  => "The input does not fit the date format '%format%'",
	);

	/**
	 * @var array
	 */
	protected $messageVariables = array(
		'format' => 'format',
	);

	/**
	 * Sets validator options
	 *
	 * @param  string|array|\Traversable $options OPTIONAL
	 */
	public function __construct($options = array())
	{
		if ($options instanceof \Traversable)
		{
			$options = iterator_to_array($options);
		}
		elseif (!is_array($options))
		{
			$options = func_get_args();
			$temp['format'] = array_shift($options);
			$options = $temp;
		}

		parent::__construct($options);
	}

	public function getFormat()
	{
		return $this->format;
	}

	public function setFormat($format)
	{
		$this->format = $format;
		return $this;
	}

	public function isValid($value)
	{
		$date = new \DateTime();
		$formatDate = $date->createFromFormat($this->format, $value);

		if (!$formatDate || $formatDate->format($this->format) != $value)
		{
			$this->error(self::INVALID_DATE);
			return false;
		}

		return true;
	}
}