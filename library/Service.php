<?php

namespace Module\Oauth;

abstract class Service {

	/**
	 * Scopes map
	 *
	 * @var array
	 */
	protected static $scopes = array();

	abstract public function getName();

	abstract public function getId();

	abstract public function getAuthoirizeUrl($scope);

	/**
	 * Should handle authorization callback and return given access tokent
	 * @return string
	 */
	abstract public function handleCallback();

	/**
	 * Should return user unique id from oauth service
	 *
	 * @return string
	 * @param string $accessToken
	 */
	abstract public function getUserId($accessToken);

	/**
	 * Convert module scope name into service scope name (@see \Module\Oauth\Scope)
	 *
	 * @return string
	 * @param string $id
	 *
	 * @throws \Exception
	 */
	public function getScope($id) {
		if (isSet(static::$scopes[$id])) {
			return static::$scopes[$id];
		}
		throw new \RuntimeException('Scope ' . $id . ' not supported');
	}

	protected function getClientId() {
		return $this->getOption('clientId');
	}

	protected function getClientSecret() {
		return $this->getOption('clientSecret');
	}

	protected function getOption($param) {
		$config = \Nano::app()->config->get('oauth');
		$id     = $this->getId();
		$result = $config->$id;
		if ($result && $result->$param) {
			return $result->$param;
		}
		return null;
	}

}