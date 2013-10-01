<?php

namespace Module\Oauth;

use Nano\Exception;

abstract class Service {

	/**
	 * Scopes map
	 *
	 * @var array
	 */
	protected static $scopes = array();

	/**
	 * @return string
	 */
	abstract public function getName();

	/**
	 * @return string
	 */
	abstract public function getId();

	/**
	 * @return string
	 * @param $scope
	 */
	abstract public function getAuthoirizeUrl($scope);

	/**
	 * Should handle authorization callback and return given access tokent
	 * @return string
	 *
	 * @throws \Nano\Exception
	 */
	abstract public function handleCallback();

	/**
	 * Should return user data parsed from oauth service
	 *
	 * @return \Module\Oauth\UserData
	 * @param string $token token returned by {@see handleCallback}
	 *
	 * @throws \Nano\Exception
	 */
	abstract public function getUserData($token);

	/**
	 * Convert module scope name into service scope name (@see \Module\Oauth\Scope)
	 *
	 * @return string
	 * @param string $name
	 *
	 * @throws \Nano\Exception
	 */
	public function getScope($name) {
		if (isSet(static::$scopes[$name])) {
			return static::$scopes[$name];
		}
		throw new Exception('Scope ' . $name . ' not supported');
	}

	protected function getClientId() {
		return $this->getOption('clientId');
	}

	protected function getClientSecret() {
		return $this->getOption('clientSecret');
	}

	protected function getOption($param) {
		$config  = \Nano::app()->config->get('oauth');
		$service = $this->getId();
		$result  = $config->$service;
		if ($result && $result->$param) {
			return $result->$param;
		}
		return null;
	}

}