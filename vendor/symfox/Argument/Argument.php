<?php

namespace Symfox\Argument;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

class Argument
{
	protected $argumentResolver;

	public function __construct()
	{
		$this->setArgumentResolver();
	}

	protected function setArgumentResolver() 
	{
		$this->argumentResolver = new ArgumentResolver();
	}

	public function getResolver()
	{
		return $this->argumentResolver;
	}
} 