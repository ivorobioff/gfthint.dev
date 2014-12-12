<?php
namespace Developer\DAL\Mapper;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\RuntimeException;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 *
 * @method Mapper get($mapperName)
 */
class MapperManager extends AbstractPluginManager
{
	protected $shareByDefault = false;

	public function validatePlugin($plugin)
	{
		if (!$plugin instanceof MapperInterface)
		{
			throw new RuntimeException('Mapper object must be instance of MapperInterface');
		}
	}
}