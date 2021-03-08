<?php

/** 
 * Symfox : Agile, Extensible, Fast and Modular 
 * 
 * @alias Sunshine
 * @version 21.3
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

// Load dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load environment variables
(new \Symfony\Component\Dotenv\Dotenv())->bootEnv(__DIR__.'/../.env');

// Set Environment
\Boot\Env\Environment::set($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Instantiate Application Container
$app = require_once __DIR__ . '/../boot/application.php';

// Instantiate Kernel
$kernel = new \Boot\Kernel($app);

// Getting the current request
$request = \Symfox\Request\RequestAction::createFromGlobals();

// Handle the request and get response
$response = $kernel->process($request);

// Send the respones to user client 
$response->send(); 

// Terminate the cycle
$kernel->terminate($request, $response);