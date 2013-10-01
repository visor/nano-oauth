<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Nano\Exception;

class Feedly extends Service {

	public function getName() {
		return 'Feedly';
	}

	public function getId() {
		return 'feedly';
	}

	public function getAuthoirizeUrl($scope) {
		return null;
	}

	public function handleCallback() {
		throw new Exception('Not implemented yet');
	}

	/**
	 * Should return user unique id from oauth service
	 *
	 * @return string
	 * @param string $token token returned by {@see handleCallback}
	 *
	 * @throws Exception
	 */
	public function getUserData($token) {
		throw new Exception('Not implemented yet');
	}

}