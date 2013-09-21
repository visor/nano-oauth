<?php /** @var \Nano\Routes $routes */

$routes
	->module('oauth')
		->get('', 'index', 'index')
		->section('callback/')
			->get('~(?P<service>.+)', 'index', 'callback')
		->end()

	->module(null)
;
