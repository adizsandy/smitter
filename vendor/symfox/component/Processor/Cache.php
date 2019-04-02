<?php

namespace Symfox\Component\Processor;

class Cache{

	private $response;
	private $desDir = __DIR__.'/../../../../app/design/';
	private $tempExtension = '.php';

	public function __construct(){
		//....
		$this->response = new Response();
	}

	public function render($template, $options = []){
		$content = $this->createContent($template, $options);
		$this->response->setContent($content);
		return $this->response;
	}

	private function createContent($template, $options){

		ob_start();

		extract($options, EXTR_SKIP);
		require $this->desDir.$template.$this->tempExtension;

		$content = ob_get_contents();
		
		ob_end_clean();

		return $content;
	}

} 