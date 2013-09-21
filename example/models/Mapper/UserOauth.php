<?php

namespace App\Model\Mapper;

use App\Model\User;
use Module\Orm\Factory;
use Module\Orm\Mapper;

class UserOauth extends Mapper implements \Module\Oauth\Mapper {

	protected $modelClass = '\App\Model\UserOauth';

	/**
	 * @return \Module\Manager\Guest;
	 * @param string $service    Internal service id
	 * @param string $serviceUid User ID provided by service
	 */
	public function findServiceUser($service, $serviceUid) {
		$criteria = Factory::criteria()
			->equals('service', $service)
			->and->equals('serviceUid', $serviceUid)
		;
		$found = $this->dataSource()->get($this->getResource(), $criteria);
		if ($found) {
			return User::mapper()->get($found['userId']);
		}

		$result = new User();
		$result->username = 'Created for ' . $service . ' ' . $serviceUid;
		$result->save();

		$map = new \App\Model\UserOauth();
		$map->userId     = $result->id;
		$map->service    = $service;
		$map->serviceUid = $serviceUid;
		$map->save();

		return $result;
	}

	/**
	 * @return array
	 */
	protected function getMeta() {
		return array(
			'name'       => 'user_oauth'
			, 'fields'   => array(
				'userId'         => array(
					'type'   => 'integer'
					, 'null' => false
				)
				, 'service'    => array(
					'type'   => 'string'
					, 'null' => false
				)
				, 'serviceUid' => array(
					'type'   => 'string'
					, 'null' => false
				)
			)
			, 'identity' => array('userId', 'service')
		);
	}

}