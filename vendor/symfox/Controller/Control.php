<?php

namespace Symfox\Controller;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control {

	public function getResolver()
	{
		return new ControllerResolver();
	}

} 
