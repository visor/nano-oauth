<?php

namespace App\Model\Mapper;

use Module\Orm\Factory;
use Module\Orm\Mapper;

class User extends Mapper {

	protected $modelClass = '\App\Model\User';

	public function findByEmail($email) {
		$criteria = Factory::criteria()->equals('email', $email);
		$found = $this->dataSource()->get($this->getResource(), $criteria);
		if ($found) {
			return self::load($found);
		}
		return null;
	}

	/**
	 * @return array
	 */
	protected function getMeta() {
		return array(
			'name'          => 'user'
			, 'fields'      => array(
				'id'         => array(
					'type'       => 'integer'
					, 'readonly' => true
				)
				, 'username'    => array(
					'type'   => 'string'
					, 'null' => false
				)
				, 'login'    => array(
					'type'   => 'string'
					, 'null' => false
				)
				, 'email'    => array(
					'type'   => 'string'
					, 'null' => false
				)
				, 'password' => array(
					'type'   => 'string'
					, 'null' => false
				)
				, 'token'    => array(
					'type'   => 'string'
					, 'null' => false
				)
			)
			, 'incremental' => 'id'
			, 'identity'    => array('id')
		);
	}

}