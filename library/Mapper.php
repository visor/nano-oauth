<?php

namespace Module\Oauth;

interface Mapper {

	/**
	 * @return \Module\Manager\Guest;
	 * @param string $service     Internal service id
	 * @param string $serviceUid  User ID provided by service
	 */
	public function findServiceUser($service, $serviceUid);

}