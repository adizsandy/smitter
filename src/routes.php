<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// ......... Define routes from here

$routes->add('home', new Route('/', array('_controller' => 'App\Controller\HomeController::index')));
$routes->add('number_game', new Route('/number-game/{number}', array('_controller' => 'App\Controller\HomeController::numberGame')));
//$routes->add('double_page', new Route('/double-page/{name}'), ['name'=>'Dem']);

// ........ End route definitions

return $routes;