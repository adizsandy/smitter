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
			'driver' => 'default', 
		]
	], 
	'template' => [
		'default' => [ 
			'driver' => 'php'
		]
	],
	'mail' => [
		'default' => [
			'driver' => $_SERVER['MAIL_DRIVER'],
			'host' => $_SERVER['MAIL_HOST'],
			'port' => $_SERVER['MAIL_PORT'],
			'username' => $_SERVER['MAIL_USERNAME'],
			'password' => $_SERVER['MAIL_PASSWORD'],
			'encryption' => $_SERVER['MAIL_ENCRYPTION']
		]
	]
];