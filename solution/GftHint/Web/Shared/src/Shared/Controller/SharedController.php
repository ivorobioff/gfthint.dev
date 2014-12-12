<?php
namespace GftHint\Web\Shared\Controller;
use Developer\Hydrator\HydratorManager;
use Developer\Model\ModelManagerAwareInterface;
use Developer\Model\ModelManagerAwareTrait;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SharedController extends AbstractActionController implements ModelManagerAwareInterface
{
	use ModelManagerAwareTrait;

	protected function error404()
	{
		/**
		 * @var Response $response
		 */
		$response = $this->getResponse();
		$response->setStatusCode(Response::STATUS_CODE_404);

		return [];
	}

	/**
	 * @param array $data
	 * @return JsonModel
	 */
	protected function outputSuccess(array $data = null)
	{
		return new JsonModel([
			'meta' => [
				'code' => 200
			],
			'data' => $data
		]);
	}

	protected function outputError($message)
	{
		return new JsonModel([
			'meta' => [
				'code' => 400,
				'message' => $message
			]
		]);
	}

	/**
	 * @return HydratorManager
	 */
	public function getHydratorManager()
	{
		return $this->getServiceLocator()->get('AdminHydratorManager');
	}
} 