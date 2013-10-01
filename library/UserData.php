<?php

namespace Module\Oauth;

class UserData {

	protected $uid;
	protected $email;
	protected $nickName;
	protected $userName;

	public function __construct($uid) {
		$this->uid = $uid;
	}

	/**
	 * @return string
	 */
	public function getUid() {
		return $this->uid;
	}

	/**
	 * @return \Module\Oauth\UserData
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return \Module\Oauth\UserData
	 * @param string $nickName
	 */
	public function setNickName($nickName) {
		$this->nickName = $nickName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNickName() {
		return $this->nickName;
	}

	/**
	 * @return \Module\Oauth\UserData
	 * @param string $userName
	 */
	public function setUserName($userName) {
		$this->userName = $userName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserName() {
		return $this->userName;
	}

}