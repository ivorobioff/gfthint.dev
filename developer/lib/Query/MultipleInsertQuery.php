<?php
namespace Developer\Query;
use Developer\DAL\Mapper\SqlObjectAwareInterface;
use Developer\DAL\Query\AbstractQuery;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\TableIdentifier;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class MultipleInsertQuery extends AbstractQuery
{
	private $data;

	/**
	 * @param array|\Traversable $data
	 * @param string $mapperName
	 */

	private $updateAllOnDuplicate = false;

	private $sqlProvider;

	public function __construct($data, SqlObjectAwareInterface $sqlProvider)
	{
		if ($data instanceof \Traversable)
		{
			$this->data = iterator_to_array($data);
		}
		else
		{
			$this->data = $data;
		}

		$this->sqlProvider = $sqlProvider;
	}

	public function execute()
	{
		if (!$this->data) return ;

		$adapter = $this->sqlProvider->getSqlObject()->getAdapter();

		if (!$adapter instanceof Adapter)
		{
			throw new \RuntimeException('Unknown adapter for this query');
		}

		$adapter->query($this->prepareQuery())->execute();
	}

	public function setOnDuplication()
	{
		throw new \RuntimeException(__METHOD__.' is not implemented');
	}

	public function setUpdateAllOnDuplicate($flag)
	{
		$this->updateAllOnDuplicate = $flag;
	}

	private function prepareQuery()
	{
		$platform = $this->getPlatform();
		$table = $this->sqlProvider->getSqlObject()->getTable();

		if ($table instanceof TableIdentifier)
		{
			$table = $table->getTable();
		}

		$quotedTable = $platform->quoteIdentifier($table);

		$fields = '';
		foreach (array_keys(reset($this->data)) as $field)
		{
			$fields .= ','.$platform->quoteIdentifier($field);
		}

		$fields = ltrim($fields, ',');

		$values = '';
		foreach ($this->data as $row)
		{
			$values .= ',('.$this->quoteValueList(array_values($row)).')';
		}

		$values = ltrim($values, ',');

		return 'INSERT INTO '.$quotedTable.' ('.$fields.') VALUES '.$values.' '.$this->prepareOnDuplicate();
	}

	private function prepareOnDuplicate()
	{
		if (!$this->updateAllOnDuplicate)
		{
			return '';
		}

		$keys = array_keys(reset($this->data));
		$p = $this->getPlatform();

		$str = '';
		$d = '';

		foreach ($keys as $key)
		{
			$str .= $d.$p->quoteIdentifier($key).'=VALUES('.$p->quoteIdentifier($key).')';
			$d = ',';
		}

		return 'ON DUPLICATE KEY UPDATE '.$str;
	}

	/**
	 * The original method has a bug, so it is the alternative for it
	 * @param array $valueList
	 * @return string
	 */
	private function quoteValueList($valueList)
	{
		foreach ($valueList as $key => $value)
		{
			$valueList[$key] = $this->getPlatform()->quoteValue($value);
		}
		return implode(', ', $valueList);
	}

	private function getPlatform()
	{
		return $this->sqlProvider->getSqlObject()->getAdapter()->getPlatform();
	}
}