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
		echo $service->getName(),
			'<pre>',
				'id:    ', $user->getId(), PHP_EOL,
				'login: ', $user->getLogin(), PHP_EOL,
				'email: ', $user->getEmail(), PHP_EOL,
				'name:  ', $user->getUserName(), PHP_EOL,
			'</pre> '
		;
	}

	protected function before() {
		$this->services = \app()->oauth->getServices();
	}

}