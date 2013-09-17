<?php

namespace Module\Oauth;

interface Service {

	public function getName();

	public function getAuthoirizeUrl($scope);

	public function getAccessUrl($code);

	public function handleCallback(array $params);

	/**
	 * Convert module scope name into service scope name (@see \Module\Oauth\Scope)
	 * @return string
	 * @param string $id
	 *
	 * @throws \Exception
	 */
	public function getScope($id);

}