<?php

namespace Symfox\Match;

use Boot\Env\Configurator;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Matche {

	protected $routes;

	public function __construct()
	{	
		$this->setMatcher();
	}

	protected function setMatcher() 
	{
		$this->routes = new RouteCollection;
		$custom_routes = Configurator::getRouteCollection();
		if (! empty($custom_routes) && count($custom_routes) > 0 ) {
			foreach ($custom_routes as $name => $info) {
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



