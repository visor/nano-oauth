#!/bin/env php
<?php

require __DIR__ . '/bootstrap.php';

function init($name) {
	$db = __DIR__ . '/' . $name . '.sqlite';
	if (file_exists($db)) {
		unLink($db);
	}
	return new \PDO('sqlite:' . $db);
}

function create(\PDO $pdo) {
	$pdo->exec('
		create table user (
			id integer not null primary key,
			username text,
			token text,
			password text default null
		)
	');

	$pdo->exec('
		create table user_oauth (
			userId integer not null,
			service text,
			serviceUid text not null,

			primary key (userId, service)
		)
	');
}

create(init('database'));
create(init('test-database'));