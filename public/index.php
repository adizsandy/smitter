<?php

/**
 * Symfox : Modular, Extensible and Agile  
 * 
 * @alias Sunshine
 * @version 2.0.1 | Rising  
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

use Symfox\Sunshine\Framework;  
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

// Load All dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load all environment variables
(new Dotenv())->bootEnv(dirname(__DIR__).'/../.env');

// Initiate application
$app = new Framework ($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);

// Request response lifecycle
$request = Request::createFromGlobals();

$response = $app->handle($request);

$response->send();
 