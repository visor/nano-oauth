<?php

namespace App\Model\Mapper;

use Module\Orm\Mapper;

class User extends Mapper {

	protected $modelClass = '\App\Model\User';

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