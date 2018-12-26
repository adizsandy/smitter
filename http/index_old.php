<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfox\Router;
use Symfox\Framework;
use Symfox\DispatchProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

$config = require __DIR__.'/../src/register/config.php';
$constants = require __DIR__.'/../src/register/constants.php';
$events = require __DIR__.'/../src/register/events.php';
$listeners = require __DIR__.'/../src/register/listeners.php';
$routes = require __DIR__.'/../src/register/routes.php';

$routeCollection = (new Router())->collect($routes);
$context = new RequestContext();

$dispatcher = new DispatchProcessor($events, $listeners);
$matcher = new UrlMatcher($routeCollection, $context);
$argumentResolver = new ArgumentResolver();
$controllerResolver = new ControllerResolver();

$framework = new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);

$request = Request::createFromGlobals();
$response = $framework->handle($request);

$response->send();