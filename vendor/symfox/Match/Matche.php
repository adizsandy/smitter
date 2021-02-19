<?php

namespace Symfox\Match;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Matche {

	protected $routes;

	public function __construct($routes)
	{
		$this->routes = new RouteCollection;

		if (! empty($routes)) {//dd($routes);
			foreach($routes as $name => $info) {
				$this->routes->add($name, new Route($info[0], array('_controller' => $info[1])));
			}
		} 
	}

	public function getMatcher()
	{
		$context = new RequestContext();
		return new UrlMatcher($this->routes, $context);
	}

} 



