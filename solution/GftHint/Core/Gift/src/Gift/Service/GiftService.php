<?php
namespace GftHint\Core\Gift\Service;
use GftHint\Core\Gift\Interfaces\GiftRepositoryInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class GiftService 
{
	private $repository;

	public function __construct(GiftRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
} 