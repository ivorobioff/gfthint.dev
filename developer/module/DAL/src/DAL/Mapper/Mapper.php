<?php
namespace Developer\DAL\Mapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Metadata\Metadata;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Mapper implements MapperInterface, SqlObjectAwareInterface
{
	private $sql;

	private static $columnsCache = [];

	/**
	 * @return Sql
	 */
	public function getSqlObject()
	{
		return $this->sql;
	}

	public function setSqlObject(Sql $sql)
	{
		$this->sql = $sql;
	}

	/**
	 * @return string
	 */
	public function getTableName()
	{
		return $this->getSqlObject()->getTable();
	}

	/**
	 * @param bool $useNamespace
	 * @return array
	 */
	public function getColumnNames($useNamespace = false)
	{
		$table = $this->getTableName();

		if (!isset(static::$columnsCache[$table]))
		{
			/**
			 * @var Adapter $adapter
			 */
			$adapter  = $this->getSqlObject()->getAdapter();
			$metadata = new Metadata($adapter);

			static::$columnsCache[$table] = $metadata->getColumnNames($table);
		}

		$columns = static::$columnsCache[$table];

		if ($useNamespace)
		{
			$nColumns = [];

			foreach ($columns as $column)
			{
				$nColumns[$table.'_'.$column] = $column;
			}

			$columns = $nColumns;
		}

		return $columns;
	}

	public function extractOwnColumns(array $row)
	{
		$table = $this->getTableName();

		$result = [];

		foreach ($row as $name => $value)
		{
			if (preg_match('/^'.preg_quote($table.'_').'/', $name))
			{
				$field = substr($name, strlen($table.'_'));
				$result[$field] = $value;
			}
		}

		return $result;
	}

	/**
	 * @param Where $where
	 * @param Options $options
	 * @return ResultInterface
	 */
	private function loadRawBy(Where $where = null, Options $options = null)
	{
		$sql = $this->getSqlObject();
		$select = $sql->select();

		if ($where !== null)
		{
			$select->where($where);
		}

		if ($options)
		{
			if ($options->hasLimit()) $select->limit((int)$options->getLimit());
			if ($options->hasOffset()) $select->offset((int)$options->getOffset());
			if ($options->hasOrderBy()) $select->order($options->getOrderBy());
			if ($options->hasGroupBy()) $select->group($options->getGroupBy());
			if ($options->hasColumns()) $select->columns($options->getColumns());
		}

		$statement = $sql->prepareStatementForSqlObject($select);

		return $statement->execute();
	}

	/**
	 * @param Where $where
	 * @param Options $options
	 * @return Result
	 */
	public function loadAllBy(Where $where, Options $options = null)
	{
		$result = $this->loadRawBy($where, $options);
		return new Result($result);
	}

	/**
	 * @param Options $options
	 * @return Result
	 */
	public function loadAll(Options $options = null)
	{
		$result = $this->loadRawBy(null, $options);
		return new Result($result);
	}

	public function existsBy(Where $where)
	{
		$options = new Options();
		$options->setLimit(1);

		$result = $this->loadRawBy($where, $options);
		return (bool) $result->current();
	}

	public function countBy(Where $where)
	{
		$sql = $this->getSqlObject();
		$select = $sql->select();
		$select->where($where);
		$select->limit(1);
		$select->columns(['count' => new Expression('COUNT(*)')]);
		$statement = $sql->prepareStatementForSqlObject($select);
		$result = $statement->execute()->current();
		return $result['count'];
	}

	/**
	 * @param Where $where
	 * @param Options $options
	 * @return array|null
	 */
	public function loadBy(Where $where, Options $options = null)
	{
		if ($options === null)
		{
			$options = new Options();
		}

		$options->setLimit(1);

		$result = $this->loadRawBy($where, $options);

		if (!$row = $result->current()) return null;

		return $row;
	}

	public function deleteBy(Where $where)
	{
		$sql = $this->getSqlObject();
		$delete = $sql->delete();

		$delete->where($where);

		$statement = $sql->prepareStatementForSqlObject($delete);
		$statement->execute();
	}

	public function updateBy(Where $where, array $data)
	{
		$sql = $this->getSqlObject();
		$update = $sql->update();

		$update->where($where);
		$update->set($data);

		$statement = $sql->prepareStatementForSqlObject($update);
		$statement->execute();
	}

	/**
	 * @param $data
	 * @return mixed|null|int
	 */
	public function insert($data)
	{
		if ($data instanceof \Traversable)
		{
			$data = iterator_to_array($data);
		}

		$insert = $this->getSqlObject()->insert();

		$insert->values($data);

		$result = $this->getSqlObject()
			->prepareStatementForSqlObject($insert)
			->execute();

		return $result->getGeneratedValue();
	}
}