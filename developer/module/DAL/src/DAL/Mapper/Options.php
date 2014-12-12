<?php
namespace Developer\DAL\Mapper;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Options 
{
	const DESC = 'DESC';
	const ASC = 'ASC';

	private $limit;
	private $offset;
	private $order = [];
	private $group;
	private $columns;

	public function setLimit($limit)
	{
		$this->limit = $limit;
	}

	public function hasLimit()
	{
		return $this->limit !== null;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function setOffset($num)
	{
		$this->offset = $num;
	}

	public function hasOffset()
	{
		return $this->offset !== null;
	}

	public function getOffset()
	{
		return $this->offset;
	}

	public function addOrderBy($fields, $way)
	{
		$this->order[] = $fields.' '.$way;
	}

	public function hasOrderBy()
	{
		return $this->order != null;
	}

	public function getOrderBy()
	{
		return $this->order;
	}

	public function setGroupBy($field)
	{
		$this->group = $field;
	}

	public function hasGroupBy()
	{
		return $this->group !== null;
	}

	public function getGroupBy()
	{
		return $this->group;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function setColumns(array $columns)
	{
		$this->columns = $columns;
	}

	public function hasColumns()
	{
		return $this->columns !== null;
	}
} 