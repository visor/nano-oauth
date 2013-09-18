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

	abstract public function getAuthoirizeUrl($scope);

	abstract public function getAccessUrl($code);

	/**
	 * Should handle authorization callback and return given access tokent
	 * @return string
	 */
	abstract public function handleCallback();

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

}