<?php

namespace Symfox\Controller;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control {

	public function getResolver()
	{
		return new ControllerResolver();
	}

	public function handleRequest($control, $args)
	{	
		return call_user_func_array($control, $args);
	}

} 
