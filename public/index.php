<?php

/** 
 * Symfox : Agile, Extensible, Fast and Modular 
 * 
 * @alias Sunshine
 * @version 2.21.3
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

// Start Timer
define('GET_SUNSHINE', microtime(true));

// Load All dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load all environment variables
(new \Symfony\Component\Dotenv\Dotenv())->bootEnv(__DIR__.'/../.env');

// Set Environment
\Boot\Env\Environment::set($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Load Application Container
require_once __DIR__ . '/../boot/application.php';

// Lit Up The Core
$kernel = new \Boot\Kernel($app);

// Getting the current request
$request = \Symfox\Request\RequestAction::createFromGlobals();

// Handle the request and get response
$response = $kernel->process($request);

// Send the respones to user client 
$response->send(); 

// Terminate the kernel
$kernel->terminate($request, $response);