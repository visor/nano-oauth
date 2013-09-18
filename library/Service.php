<?php

namespace Module\Oauth;

interface Service {

	public function getName();

	public function getAuthoirizeUrl($scope);

	public function getAccessUrl($code);

	/**
	 * Should handle authorization callback and return given access tokent
	 * @return string
	 */
	public function handleCallback();

	/**
	 * Convert module scope name into service scope name (@see \Module\Oauth\Scope)
	 * @return string
	 * @param string $id
	 *
	 * @throws \Exception
	 */
	public function getScope($id);

}