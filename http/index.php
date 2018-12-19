<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfox\Framework as Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpCache;

$routes = require_once __DIR__.'/../src/register/routes.php';
$events = require_once __DIR__.'/../src/register/events.php';
$listeners = require_once __DIR__.'/../src/register/listeners.php';

$context = new RequestContext();
$request = Request::createFromGlobals();
$argumentResolver = new ArgumentResolver();
$controllerResolver = new ControllerResolver();

$matcher = new UrlMatcher($routes, $context);

$framework = new Framework($events, $listeners, $matcher, $controllerResolver, $argumentResolver);
$framework = new Symfony\Component\HttpKernel\HttpCache\HttpCache($framework,new Symfony\Component\HttpKernel\HttpCache\Store(__DIR__.'/../storage/cache'));
//print_r($framework);
$response = $framework->handle($request);

$response->send();