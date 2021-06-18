<?php

/** 
 * Symfox : Agile, Extensible, Fast and Modular 
 * 
 * @alias Sunshine
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://github.com/adizsandy/symfox
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

// Load dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load environment variables
(new \Symfony\Component\Dotenv\Dotenv())->bootEnv(__DIR__.'/../.env');

// Set Environment
\Symfox\Environment\Environment::set($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Instantiate Application Container 
$app = require_once __DIR__.'/../boot/application.php';

// Get Kernel
$kernel = $app->get('kernel');

// Get the current request 
$request = $app->get('request');

// Handle the request and get response
$response = $kernel->process($request);

// Send the respones to user client 
$response->send(); 

// Terminate the cycle
$kernel->terminate($request, $response);