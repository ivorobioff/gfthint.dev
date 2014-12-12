<?php
namespace GftHint\Web\Account\Access;
use Developer\ChkAccess\AbstractStrategy;
use Developer\ChkAccess\Condition;
use GftHint\Core\User\Service\AccountService;
use Zend\Http\PhpEnvironment\Response;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AuthStrategy extends AbstractStrategy
{
	/**
	 * @return int
	 */
	public function getCondition()
	{
		/**
		 * @var AccountService $accountService
		 */
		$accountService = $this->getServiceLocator()->get('AccountService');

		if ($accountService->getUser() === null)
		{
			return Condition::NEGATIVE;
		}

		return Condition::POSITIVE;
	}

	/**
	 * @param int $passCondition
	 * @return Response
	 */
	public function handleAccessDenied($passCondition)
	{
		if ($passCondition === Condition::NEGATIVE)
		{
			return $this->redirect('default');
		}

		$event = $this->getEvent();
		$event->getRouteMatch()->setParam('controller', 'AccountAccess');
		$event->getRouteMatch()->setParam('action', 'index');

		return null;
	}
}