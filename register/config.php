<?php

return [
	
	'database' => [
		'default' => [
			'active' => 'yes',
			'prefix' => '',
			'driver' => 'mysql',
			'host' => 'localhost',
	        'database' => 'symfox',
	        'username' => 'root',
	        'password' => '',
	        'charset'   => 'utf8',
    		'collation' => 'utf8_unicode_ci',
		]
	],

	'cache' => [
		'default' => [
			'active' => 'no',
			'driver' => 'apc',

		]
	],

	'template' => [
		'default' => [
			'active' => 'no',
			'driver' => 'blade'
		]
	]
];