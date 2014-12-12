<?php
namespace Developer\DAL\Mapper;
use Zend\Db\Sql\Sql;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface SqlObjectAwareInterface
{
	public function setSqlObject(Sql $sql);

	/**
	 * @return Sql
	 */
	public function getSqlObject();
} 