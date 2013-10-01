<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;
use Module\Oauth\UserData;
use Nano\Exception;

class Google extends Service {

	const AUTHORIZE_URL    = 'https://accounts.google.com/o/oauth2/auth';
	const ACCESS_TOKEN_URL = 'https://accounts.google.com/o/oauth2/token';
	const USER_URL         = 'https://www.googleapis.com/oauth2/v3/userinfo';

	protected static $scopes = array(
		Scope::BASIC   => 'openid profile'
		, Scope::USER  => 'openid profile'
		, Scope::EMAIL => 'openid profile email'
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
			. '&redirect_uri=' . urlEncode($this->getRedirectUri())
			. '&response_type=code'
			. '&scope=' . $this->getScope($scope)
		;
	}

	public function handleCallback() {
		$code = (string)$_GET['code'];
		$request = new \HttpRequest(self::ACCESS_TOKEN_URL, \HttpRequest::METH_POST);
		$request->setPostFields(array(
			'code' => $code,
			'client_id' => $this->getClientId(),
			'client_secret' => $this->getClientSecret(),
			'redirect_uri' => $this->getRedirectUri(),
			'grant_type' => 'authorization_code',
		));
		$response = $request->send();
		$params   = json_decode($response->getBody());

		if (isSet($params->error)) {
			throw new Exception($params->error);
		}

		return $params->access_token;
	}

	/**
	 * Should return user unique id from oauth service
	 *
	 * @return string
	 * @param string $token token returned by {@see handleCallback}
	 *
	 * @throws \Nano\Exception
	 */
	public function getUserData($token) {
		$request = new \HttpRequest(self::USER_URL . '?access_token=' . $token);
		$response = $request->send();
		$user = json_decode($response->getBody());

		$result = new UserData($user->sub, isSet($user->email) ? $user->email : null);
		if (isSet($user->name)) {
			$result->setUserName($user->name);
			$result->setNickName($user->name);
		}
		if (isSet($user->email)) {
			$result->setEmail($user->email);
			$result->setNickName($user->name);
		}

		return $result;
	}

	protected function getRedirectUri() {
		return $this->getOption('callback');
	}

}