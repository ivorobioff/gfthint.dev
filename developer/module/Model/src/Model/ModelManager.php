<?php
namespace Developer\Model;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\Exception\RuntimeException;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ModelManager extends AbstractPluginManager
{
	protected $shareByDefault = false;

	private $options;

	public function __construct(Config $config = null, array $options = [])
	{
		parent::__construct($config);
		$this->options = $options;
	}

	public function validatePlugin($plugin)
	{
		if (!is_object($plugin))
		{
			throw new RuntimeException('Model must be an object');
		}
	}

	/**
	 * @param string $name
	 * @param array $options
	 * @param bool $usePeeringServiceManagers
	 * @return object
	 */
	public function get($name, $options = array(), $usePeeringServiceManagers = true)
	{
		if (!$this->has($name))
		{
			$name = $this->prependNamespacePrefix($name);
		}

		return parent::get($name, $options, $usePeeringServiceManagers);
	}

	private function prependNamespacePrefix($name)
	{
		if (!isset($this->options['namespace_prefix']))
		{
			return $name;
		}

		return rtrim($this->options['namespace_prefix'], '\\').'\\'.ltrim($name, '\\');
	}
}