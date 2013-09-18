<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;
use Nano\Exception;

class Github extends Service {

	const AUTHORIZE_URL    = 'https://github.com/login/oauth/authorize';
	const ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';
	const USER_URL         = 'https://api.github.com/user';

	private static $scopes = array(
		Scope::BASIC    => ''
		, Scope::USER  => 'user'
		, Scope::EMAIL => 'user:email'
	);

	public function getName() {
		return 'GitHub';
	}

	public function getId() {
		return 'github';
	}

	public function getAuthoirizeUrl($scope) {
		return self::AUTHORIZE_URL
			. '?client_id=' . $this->getClientId()
			. '&scope=' . $this->getScope($scope)
		;
	}

	public function handleCallback() {
		$code = (string)$_GET['code'];
		$request = new \HttpRequest($this->getAccessUrl($code), \HttpRequest::METH_POST);
		$request->setPostFields(array(
			'client_id' => $this->getClientId(),
			'client_secret' => $this->getClientSecret(),
			'code' => $code,
		));
		$response = $request->send();
		$params   = array();
		parse_str($response->getBody(), $params);
		if (isSet($params['error'])) {
			throw new Exception($params['error']);
		}
		if (!isSet($params['access_token'])) {
			throw new Exception('Strange');
		}
		return $params['access_token'];
	}

	public function getAccessUrl($code) {
		return self::ACCESS_TOKEN_URL;
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
		return \Nano::app()->config->get('oauth')->github->clientId;
	}

	protected function getClientSecret() {
		return \Nano::app()->config->get('oauth')->github->clientSecret;
	}

}