<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

class Argument{

	private $argumentResolver;

	public function __construct(){
		$this->argumentResolver = new ArgumentResolver();
	}

	public function getResolver(){
		return $this->argumentResolver;
	}
} 