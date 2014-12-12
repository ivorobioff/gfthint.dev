<?php
namespace GftHint\Web\Shared\View\ViewHelper;
use Developer\ApplicationServiceLocatorProviderTrait;
use GftHint\Core\User\Service\AccountService;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class IsAuth extends AbstractHelper implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;
	use ApplicationServiceLocatorProviderTrait;

	public function __invoke()
	{
		/**
		 * @var AccountService $accountService
		 */
		$accountService = $this->getApplicationServiceLocator()->get('AccountService');

		return $accountService->getUser() !== null;
	}
} 