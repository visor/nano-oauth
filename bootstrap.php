<?php

error_reporting(E_ALL | E_STRICT);
ini_set('error_log', __DIR__ . '/build/logs/error.log');
ini_set('display_errors', true);

if (!class_exists('Nano\Application', false)) {
	include __DIR__ . '/dependencies/nano/core/library/Application.php';
}

/**
 * @property \Module\Oauth\Facade $oauth
 */
class Application extends \Nano\Application {

	/**
	 * @return \Application
	 */
	public function configure() {
		parent::configure();

		$this->readOnly('oauth', new \Module\Oauth\Facade());

		return $this;
	}

}

/**
 * @return \Application
 */
function app() {
	return \Nano::app();
}

$application = \Application::create()
	->withConfigurationFormat('php')
	->withRootDir(__DIR__)
	->withModule('oauth', __DIR__)
	->configure()
;