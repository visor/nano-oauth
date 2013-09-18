<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;
use Nano\Exception;

class Google extends Service {

	private static $scopes = array(
	);

	public function getName() {
		return 'Google';
	}

	public function getId() {
		return 'google';
	}

	public function getAuthoirizeUrl($scope) {
	}

	public function handleCallback() {
	}

	public function getAccessUrl($code) {
	}

	/**
	 * Convert module scope name into service scope name (@see \Module\Oauth\Scope)
	 *
	 * @return string
	 * @param string $id
	 *
	 * @throws \Exception
	 */
	public function getScope($id) {
		if (isSet(self::$scopes[$id])) {
			return self::$scopes[$id];
		}
		throw new \RuntimeException('Scope ' . $id . ' not supported');
	}

	protected function getClientId() {
		return \Nano::app()->config->get('oauth')->google->clientId;
	}

	protected function getClientSecret() {
		return \Nano::app()->config->get('oauth')->google->clientSecret;
	}

}