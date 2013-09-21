<?php

namespace App\Model;

use Module\Manager\UserInterface;
use Module\Orm\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $token
 *
 * @method Mapper\User mapper() static
 */
class User extends Model implements UserInterface {

	/**
	 * @return boolean
	 */
	public function isGuest() {
		return false;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getLogin() {
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @return boolean
	 * @param string $otherValue
	 */
	public function checkPassword($otherValue) {
	}

	/**
	 * @return boolean
	 * @param string $newValue
	 */
	public function changePassword($newValue) {
	}

	/**
	 * @return string
	 */
	public function getEncryptedPassword() {
	}

}