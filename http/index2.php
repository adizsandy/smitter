<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfox\Framework;
use Symfony\Component\HttpFoundation\Request;

$framework = new Framework();

$request = Request::createFromGlobals();
$response = $framework->handle($request);

$response->send();