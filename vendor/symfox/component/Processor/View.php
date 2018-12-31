<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpFoundation\Response;

class View{

	private $response;
	private $options;
	private $html;

	public function __construct(){
		//....
		$this->response = new Response();
	}

	public function render($template, $options = []){
		$this->options = $options;

		$this->response->setContent($this->options);

		$this->response->send();
	}

} 