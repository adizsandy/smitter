<?php

/**
 * Symfox : Agile, Extensible, Fast and Modular   
 * 
 * @alias Sunshine
 * @version 2.0.1 | Rising  
 * @author Shudhansh Shekhar Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2021 Symfox, All rights reserved
 * @license MIT
 */

use App\Module\AppModule;
use Symfox\Sunshine\Framework;  
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

// Load All dependencies
require_once __DIR__.'/../vendor/autoload.php';

// Load all environment variables
(new Dotenv())->bootEnv(__DIR__.'/../.env');

// Load Modules
$modules = (new AppModule())->getStructure();

// Lighten Up
$symfox = new Framework ($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG'], $modules);

// Request response lifecycle
$request = Request::createFromGlobals();

$response = $symfox->handle($request);

$response->send();
 