<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control{

	private $controllerResolver;

	public function __construct(){
		$this->controllerResolver =	new ControllerResolver();
	}

	public function getResolver(){
		return $this->controllerResolver;
	}
} 