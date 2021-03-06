<?php

namespace Module\Oauth\Service;

use Module\Oauth\Service;
use Module\Oauth\Scope;
use Module\Oauth\UserData;
use Nano\Exception;

class Github extends Service {

	const AUTHORIZE_URL    = 'https://github.com/login/oauth/authorize';
	const ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';
	const USER_URL         = 'https://api.github.com/user';

	protected static $scopes = array(
		Scope::BASIC   => ''
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
		$request = new \HttpRequest(self::ACCESS_TOKEN_URL, \HttpRequest::METH_POST);
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

	/**
	 * Should return user unique id from oauth service
	 *
	 * @return \Module\Oauth\UserData
	 * @param string $token token returned by {@see handleCallback}
	 *
	 * @throws \Nano\Exception
	 */
	public function getUserData($token) {
		$request = new \HttpRequest(self::USER_URL . '?access_token=' . $token);
		$response = $request->send();
		$user = json_decode($response->getBody());

		$result = new UserData($user->id);
		if (isSet($user->email)) {
			$result->setEmail($user->email);
		}
		if (isSet($user->login)) {
			$result->setNickName($user->login);
		}
		if (isSet($user->name)) {
			$result->setUserName($user->name);
		}
		return $result;
	}

}