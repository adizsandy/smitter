<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpFoundation\Response;
use Symfox\Component\Collector\Collector as MapCollector;

class View {

	private $response;
	private $design_dir; 
	private $temp_extension = '.php';

	public function __construct()
	{ 
		$collector = new MapCollector;
		$this->design_dir = __DIR__.'/../../../../core/' . $collector->map['design'];
		$this->response = new Response();
	}

	public function render($template, $options = [])
	{
		$content = $this->createContent($template, $options);
		$this->response->setContent($content);
		return $this->response;
	}

	private function createContent($template, $options)
	{
		ob_start();
		
		extract($options, EXTR_SKIP);
		
		require $this->design_dir.'/'.$template.$this->temp_extension;

		$content = ob_get_contents();
		
		ob_end_clean();

		return $content;
	}

} 