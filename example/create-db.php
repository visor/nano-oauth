#!/bin/env php
<?php

require __DIR__ . '/bootstrap.php';

$db = __DIR__ . '/database.sqlite';
if (file_exists($db)) {
	unLink($db);
}
$pdo = new \PDO('sqlite:' . $db);
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