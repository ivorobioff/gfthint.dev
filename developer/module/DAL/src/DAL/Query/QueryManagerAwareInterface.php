<?php
namespace Developer\DAL\Query;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface QueryManagerAwareInterface
{
	public function setQueryManager(QueryManager $manager);

	/**
	 * @return QueryManager
	 */
	public function getQueryManager();
} 