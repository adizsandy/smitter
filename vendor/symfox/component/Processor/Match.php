<?php

namespace Symfox\Component\Processor;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Match{

	protected $routes;

	public function __construct($routes){
		$this->routes = new RouteCollection();

		if(!empty($routes)){
			foreach($routes->routes as $name => $info){
				$this->routes->add($name, new Route($info[0], array('_controller' => "App\\Controller\\".$info[1])));
			}
		}
	}

	public function getMatcher(){
		$context = new RequestContext();
		return new UrlMatcher($this->routes, $context);
	}

} 



