<?php
namespace GftHint\Infrastructure\User;
use Developer\DAL\Repository\AbstractRepository;
use GftHint\Core\User\Entity\User;
use GftHint\Core\User\Entity\UserFilter;
use GftHint\Core\User\Interfaces\UserRepositoryInterface;
use Zend\Db\Sql\Where;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
	/**
	 * @param UserFilter $filter
	 * @return User
	 */
	public function loadByFilter(UserFilter $filter)
	{
		$mapper = $this->getMapperManager()->get('User');
		$where = new Where();

		if ($filter->getEmail() !== null)
		{
			$where->equalTo('email', $filter->getEmail());
		}

		if ($filter->getPasswordHash() !== null)
		{
			$where->equalTo('password', $filter->getPasswordHash());
		}

		$data = $mapper->loadBy($where);

		if (!$data) return null;

		return $this->getHydratorManager()
			->get('User')
			->hydrate($data, new User());
	}
}