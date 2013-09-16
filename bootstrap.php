<?php

error_reporting(E_ALL | E_STRICT);
ini_set('error_log', __DIR__ . '/build/logs/error.log');
ini_set('display_errors', true);

if (!class_exists('Nano\Application', false)) {
	include __DIR__ . '/dependencies/nano/core/library/Application.php';
}

function app() {
	return \Nano::app();
}

$application = \Nano\Application::create()
	->withConfigurationFormat('php')
	->withRootDir(__DIR__)
	->withModule('oauth', __DIR__)
	->configure()
;