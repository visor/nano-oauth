<?php

define('TESTING', true);

$config = (object)array(
	'github' => (object)array(
		'clientId'     => 'ENTER CODE HERE',
		'clientSecret' => 'ENTER CODE HERE',
	),
);

include __DIR__ . '/../bootstrap.php';

app()->config->set('oauth', $config);