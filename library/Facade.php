<?php

namespace Module\Oauth;

use Module\Manager\UserInterface;

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

	/**
	 * @return UserInterface
	 * @param Mapper  $mapper
	 * @param Service $service
	 * @param         $token
	 */
	public function getInternalUser(Mapper $mapper, Service $service, $token) {
		return $mapper->findServiceUser($service->getId(), $service->getUserData($token));
	}

}