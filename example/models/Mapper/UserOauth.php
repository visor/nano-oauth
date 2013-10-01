<?php

namespace App\Model\Mapper;

use App\Model\User;
use Module\Oauth\UserData;
use Module\Orm\Factory;
use Module\Orm\Mapper;

class UserOauth extends Mapper implements \Module\Oauth\Mapper {

	protected $modelClass = '\App\Model\UserOauth';

	/**
	 * @return \Module\Manager\Guest;
	 * @param string $service         Internal service id
	 * @param \Module\Oauth\UserData  User data provided by service
	 */
	public function findServiceUser($service, UserData $userData) {
		$result = $this->findByUid($service, $userData->getUid());
		if ($result instanceof User) {
			return $result;
		}
		if ($userData->getEmail()) {
			$result = User::mapper()->findByEmail($userData->getEmail());
			if ($result instanceof User) {
				$this->associateWithService($result, $userData, $service);
				return $result;
			}
		}

		$result = User::createFromUserData($userData);
		$result->save();
		$this->associateWithService($result, $userData, $service);

		return $result;
	}

	protected function findByUid($service, $uid) {
		$criteria = Factory::criteria()
			->equals('service', $service)
			->and->equals('serviceUid', $uid)
		;
		$found = $this->dataSource()->get($this->getResource(), $criteria);
		if ($found) {
			return User::mapper()->get($found['userId']);
		}

		return null;
	}

	protected function associateWithService(User $user, UserData $userData, $service) {
		$result = new \App\Model\UserOauth();
		$result->userId     = $user->getId();
		$result->service    = $service;
		$result->serviceUid = $userData->getUid();
		$result->save();
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