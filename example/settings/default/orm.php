<?php return array(
	'default' => array(
		'datasource' => '\Module\Orm\DataSource\Pdo\Sqlite'
		, 'dsn'      => 'sqlite:database.sqlite'
		, 'default'  => true
	)
	, 'test' => array(
		'datasource' => '\Module\Orm\DataSource\Pdo\Sqlite'
		, 'dsn'      => 'sqlite:test-database.sqlite'
	)
);