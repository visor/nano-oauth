<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;
use Nano\Exception;

class Google extends Service {

	const AUTHORIZE_URL = 'https://accounts.google.com/o/oauth2/auth';

	private static $scopes = array(
		Scope::BASIC   => 'openid profile'
		, Scope::USER  => 'openid profile'
		, Scope::EMAIL => 'openid email'
	);

	public function getName() {
		return 'Google';
	}

	public function getId() {
		return 'google';
	}

	public function getAuthoirizeUrl($scope) {
		return self::AUTHORIZE_URL
			. '?client_id=' . $this->getClientId()
			. '&redirect_uri=' . $this->getRedirectUri()
			. '&response_type=code'
			. '&scope=' . $this->getScope($scope)
		;
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

	protected function getRedirectUri() {
		return \Nano::app()->config->get('oauth')->google->callback;
	}

}