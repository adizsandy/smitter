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

// Start Timer
define('GET_SUNSHINE', microtime(true));

// Load All dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load all environment variables
(new Dotenv())->bootEnv(__DIR__.'/../.env');

// Lighten Up The Core
$kernel = new Kernel($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Getting the current request
$request = Request::createFromGlobals();

// Handle the request and get response
$response = $kernel->handle($request);

// Send the respones to user client 
$response->send(); 

// Terminate the kernel
$kernel->finish($request, $response);