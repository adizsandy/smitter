<?php

namespace Symfox;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control{

	private $controllerResolver;

	public function __construct(){
		
		return 	new ControllerResolver();
	}
} 