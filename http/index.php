<?php

/**
 * Symfox : Melting the Rocks of PHP   
 * 
 * @version 0.0.3 | Alfa  
 * @author Shudhansh Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2019 Symfox, All rights reserved
 * @license MIT
 */

 /**  
 * HTTP Landing 
 * 
 * I/O Port of the framework
 * Accepts the request and outputs the response
 */

require_once __DIR__.'/../vendor/autoload.php';

use Symfox\Framework;
use Symfony\Component\HttpFoundation\Request;

$framework = new Framework();

$request = Request::createFromGlobals();
$response = $framework->handle($request);

$response->send();