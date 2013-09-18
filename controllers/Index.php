<?php

namespace Module\Oauth\Controller;

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

		$this->markRendered();
		$service = $this->services[$service];
		$service->handleCallback();
	}

	protected function before() {
		$this->services = app()->oauth->getServices();
	}

}