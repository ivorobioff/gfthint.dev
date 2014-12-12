<?php
namespace Developer\DAL\Mapper;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface MapperManagerAwareInterface
{
	/**
	 * @return MapperManager
	 */
	public function getMapperManager();
	public function setMapperManager(MapperManager $manager);
} 