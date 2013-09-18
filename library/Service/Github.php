<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;

class Github implements Service {

	const AUTHRIZE_URL     = 'https://github.com/login/oauth/authorize';
	const ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';

	private static $scopes = array(
		Scope::NONE    => ''
		, Scope::USER  => 'user'
		, Scope::EMAIL => 'user:email'
	);

	public function getName() {
		return 'GitHub';
	}

	public function getAuthoirizeUrl($scope) {
		return self::AUTHRIZE_URL
			. '?client_id=' . $this->getClientId()
			. '&scope=' . $this->getScope($scope)
		;
	}

	public function getAccessUrl($scope) {
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

	public function handleCallback() {
		echo $this->getName(), ' ', $_GET['code'];
	}

	protected function getClientId() {
		return \Nano::app()->config->get('oauth')->github->clientId;
	}

}