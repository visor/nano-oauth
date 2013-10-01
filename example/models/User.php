<?php

namespace App\Model;

use Module\Manager\UserInterface;
use Module\Oauth\UserData;
use Module\Orm\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $token
 *
 * @method Mapper\User mapper() static
 */
class User extends Model implements UserInterface {

	public static function createFromUserData(UserData $data) {
		$result = new self();
		$result->login    = $data->getNickName();
		$result->email    = $data->getEmail();
		$result->username = $data->getUserName();
		return $result;
	}

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
		return $this->login;
	}

	/**
	 * @return string
	 */
	public function getUserName() {
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
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