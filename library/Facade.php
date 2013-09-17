<?php

namespace Module\Oauth;

class Facade {

	public function __construct() {
	}

	public function getServices() {
		return array(
			new Service\Github()
		);
	}

}