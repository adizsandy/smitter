<?php

/**
 * Symfox : Agile, Extensible, Fast and Modular   
 * 
 * @alias Sunshine
 * @version 2.1.1 | Dawn  
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

use Boot\Kernel;  
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

// Start Time
define('SYMFOX_START', microtime(true));

// Load All dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load all environment variables
(new Dotenv())->bootEnv(__DIR__.'/../.env');

// Lighten Up
$kernel = new Kernel($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Request response lifecycle
$request = Request::createFromGlobals();

$response = $kernel->handle($request);

$response->send(); 