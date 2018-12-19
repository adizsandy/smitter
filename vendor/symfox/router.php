<?php

namespace Symfox;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router{

	private $routes;

	public function __construct(){
		$this->routes = new RouteCollection();
	}

	public function collect($routeList = []){

		if(!empty($routeList)){
			foreach($routeList as $name => $info){
				$this->routes->add($name, new Route($info[0], array('_controller' => CONTROLLER."\\".$info[1])));
			}
		}

		return $this->routes;
	}
} 