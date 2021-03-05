<?php

return [ 
    'default' => [
    	'prefix' => $_SERVER['DB_PREFIX'],
	    'driver' => $_SERVER['DB_CONNECTION'],
	    'host' => $_SERVER['DB_HOST'],
	    'database' => $_SERVER['DB_DATABASE'],
	    'username' => $_SERVER['DB_USERNAME'],
	    'password' => $_SERVER['DB_PASSWORD'],
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci'
    ],
    'db2' => [
    	'prefix' => $_SERVER['DB_PREFIX2'],
	    'driver' => $_SERVER['DB_CONNECTION2'],
	    'host' => $_SERVER['DB_HOST2'],
	    'database' => $_SERVER['DB_DATABASE2'],
	    'username' => $_SERVER['DB_USERNAME2'],
	    'password' => $_SERVER['DB_PASSWORD2'],
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci'
    ]
];