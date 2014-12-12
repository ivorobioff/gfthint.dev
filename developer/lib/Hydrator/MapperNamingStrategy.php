<?php
namespace Developer\Hydrator;
use Developer\StdHelper;
use Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class MapperNamingStrategy implements NamingStrategyInterface
{
	private $extractMap;
	private $hydrateMap;

	public function __construct(array $extractMap = [], array $hydrateMap = [])
	{
		$this->extractMap = $extractMap;
		$this->hydrateMap = $hydrateMap;
	}

	public function extract($name)
	{
		return StdHelper::valueOrDefault($this->extractMap, $name, $name);
	}

	public function hydrate($name)
	{
		return StdHelper::valueOrDefault($this->hydrateMap, $name, $name);
	}
}