<?php

namespace Symfox;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

class Argument{

	private $argumentResolver;

	public function __construct(){
		
		return 	new ArgumentResolver();
	}
} 