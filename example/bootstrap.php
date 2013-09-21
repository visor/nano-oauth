<?php

error_reporting(E_ALL | E_STRICT);
ini_set('error_log', __DIR__ . '/build/logs/error.log');
ini_set('display_errors', true);
define('MODULES', realPath(__DIR__ . '/../dependencies/nano'));

if (!class_exists('Nano\Application', false)) {
	include MODULES . '/core/library/Application.php';
}

/**
 * @property \Module\Oauth\Facade $oauth
 */
class Application extends \Nano\Application {

	public function __construct() {
		parent::__construct();

		$this
			->withConfigurationFormat('php')
			->withRootDir(__DIR__ . '')
			->withModule('common', MODULES . '/common')
			->withModule('orm', MODULES . '/orm')
			->withModule('manager', MODULES . '/manager')
			->withModule('oauth', __DIR__ . '/..')
		;
	}

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

\Application::create()->configure();