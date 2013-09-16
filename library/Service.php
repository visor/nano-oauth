<?php

namespace Module\Oauth;

interface Service {

	public function getAccessUrl($scope);

	public function handleCallback(array $params);

}