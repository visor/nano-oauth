<?php

namespace Module\Oauth\Controller;

use Nano\Controller;

class Index extends Controller {

	public $services;

	public function indexAction() {
		$this->services = app()->oauth->getServices();
	}

	public function callbackAction() {
	}

	protected function before() {
		$this->services = app()->oauth->getServices();
	}

}