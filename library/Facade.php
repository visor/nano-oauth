<?php

namespace Module\Oauth;

class Facade {

	public function __construct() {
	}

	public function getServices() {
		return array(
			'github' => new Service\Github(),
			'google' => new Service\Google(),
			'feedly' => new Service\Feedly(),
		);
	}

}