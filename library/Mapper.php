<?php

namespace Module\Oauth;

use Module\Oauth\UserData;

interface Mapper {

	/**
	 * @return \Module\Manager\Guest;
	 * @param string $service         Internal service id
	 * @param \Module\Oauth\UserData  User data provided by service
	 */
	public function findServiceUser($service, UserData $userData);

}