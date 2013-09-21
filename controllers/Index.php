<?php

namespace Module\Oauth\Controller;

use App\Model\UserOauth;
use Nano\Controller;

class Index extends Controller {

	/**
	 * @var \Module\Oauth\Service[]
	 */
	public $services;

	public function indexAction() {
	}

	public function callbackAction() {
		$service = $this->p('service');
		if (!isSet($this->services[$service])) {
			$this->pageNotFound('Unknown OAuth service');
		}

		$service = $this->services[$service];
		$token   = $service->handleCallback();
		$user    = \app()->oauth->getInternalUser(UserOauth::mapper(), $service, $token);
		$this->markRendered();

		echo $service->getName(), ' <code>', var_export($user->getId(), true), '</code> ', $user->getLogin();
	}

	protected function before() {
		$this->services = \app()->oauth->getServices();
	}

}