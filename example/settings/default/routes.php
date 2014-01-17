<?php /** @var \Nano\Routes $routes */

$routes
	->get('', 'index', 'index')
	->section('callback/')
		->get('~(?P<service>.+)', 'index', 'callback')
	->end()

;
