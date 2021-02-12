<?php

return [
	'database' => [ 
		'prefix' => $_SERVER['DB_PREFIX'],
		'driver' => $_SERVER['DB_CONNECTION'],
		'host' => $_SERVER['DB_HOST'],
        'database' => $_SERVER['DB_DATABASE'],
        'username' => $_SERVER['DB_USERNAME'],
        'password' => $_SERVER['DB_PASSWORD'],
        'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci'
	],
	'cache' => [
		'default' => [
			'active' => 'no',
			'driver' => 'apc', 
		]
	], 
	'template' => [
		'default' => [ 
			'driver' => 'php'
		]
	]
];