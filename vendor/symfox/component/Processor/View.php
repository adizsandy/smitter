<?php

namespace Symfox\Component\Processor;

use Symfox\Component\Collector\Collector as MapCollector;
use Symfox\Component\Action\ResponseAction;

class View {

	protected $session; 
	private $layout;
	private $template;
	private $data;

	public function __construct()
	{ 
		$this->session = Processor::provide_component('session');  
	}

	public function render ( $template = null, $options = null, $layout = null )
	{	
		if ( isset($template) && ! empty($template) ) $this->template = $template;
		if ( isset($layout) && ! empty($layout) ) $this->layout = $layout;
		if ( isset($options) && ! empty($options) ) $this->data = $options;

		if (! empty ($this->template) ) { 
			$content = $this->createContent($this->template, $this->data);

			if ( ! empty($content) && ! empty($this->layout) ) {
				$content = $this->setLayout( $this->layout, ['content' => $content ] );
			}
		}  

		return ResponseAction::output($content, 'html');
		//$this->response->setContent($content);
		//return $this->response;
	}

	public function layout($layout) 
	{	
		if ( !empty($layout) ) $this->layout = $layout; 
		return $this;
	}

	public function template($template) 
	{
		if ( !empty($template) ) $this->template = $template;
		return $this;
	}

	public function data($data) 
	{	
		if ( !empty($data) ) $this->data = $data; 
		return $this;
	}

	private function createContent($template, $options)
	{
		ob_start();
		
		extract($options, EXTR_SKIP);
		
		require $this->getTemplateFolder() . $template . $this->getFileExtension();

		$content = ob_get_contents();
		
		ob_end_clean();

		return $content;
	}

	private function setLayout($layout, $content) 
	{
		ob_start();
		
		extract($content, EXTR_SKIP);
		
		require $this->getLayoutFolder() . $layout . $this->getFileExtension();

		$content = ob_get_contents();
		
		ob_end_clean();

		return $content;
	}

	private function getFileExtension() 
	{
		$config = require __DIR__.'/../../../../core/' . (new MapCollector)->map['config'];

		if ( isset ( $config['template']['default'] ) && $config['template']['default']['active'] == 'yes' ) {
			if ( isset( $config['template']['default']['driver'] ) && $config['template']['default']['driver'] == 'php' ) {
				return '.php';
			}
		} else {
			return '.php';
		}
	}

	private function getLayoutFolder() 
	{
		return __DIR__.'/../../../../core/' . (new MapCollector)->map['design'] . '/layouts/';
	}

	private function getTemplateFolder() 
	{
		return __DIR__.'/../../../../core/' . (new MapCollector)->map['design'] . '/templates/';
	}

} 