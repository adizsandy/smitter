<?php

namespace Symfox\View;

use Symfony\Component\HttpFoundation\Session\Session; 
use Symfox\Response\ResponseAction;
use Symfox\Security\Auth;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class View {

	public $session; 
	public $auth; 
	private $layout;
	private $template;
	private $data;  
	private $basedir;
	private $route;
	private $module;
	private $includes = [];
	private $filehandler;
	private $cachetime;

	public function __construct($controller, $basedir, $route)
	{ 
		$this->route = $route;
		$this->basedir = $basedir;
		$this->setFileHandleService();
		$this->setModule($controller);
		$this->setSessionService();  
		$this->setAuthService();  
		$this->setCacheTime(); 
	}

	protected function setFileHandleService() 
	{
		$adapter = new Local($this->basedir . '/../../');
		$this->filehandler = new Filesystem($adapter);
	}

	protected function setModule($controller) 
	{
		$control_name = ltrim(ltrim(ltrim(get_class($controller), "App\\"), "Module"), "\\");
		$module_name = ( explode("\\Controller\\", $control_name) ) [0];
		$this->module = $module_name;
	}

	protected function getModule() 
	{
		return $this->module;
	}

	public function setCacheTime($time = null) 
	{	
		if (empty($time) ) {
			$this->cachetime = $_SERVER['VIEW_CACHE_TIME'];
		} else if ($time == false) { 
			$this->cachetime = 0;
		} else {
			$this->cachetime = $time;
		} 
		return $this;
	}

	protected function getCacheTime() 
	{
		return $this->cachetime;
	}

	protected function setSessionService() 
	{	 
		$this->session = new Session();
	}

	public function put_includes($file, $module) 
	{
		ob_start();
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
		$include_file = $this->getIncludeFile($file, $module) . $this->getFileExtension();
		if (file_exists($include_file)) include $include_file;
		$includes = ob_get_contents();
		ob_end_clean(); 
		return $includes;
	}

	protected function setAuthService() 
	{
		$this->auth = new Auth;
	}

	public function generate( $template = null, $options = null, $layout = null ) 
	{
		if ( isset($template) && ! empty($template) ) $this->setTemplate($template);
		if ( isset($layout) && ! empty($layout) ) $this->setLayout($layout);
		if ( isset($options) && ! empty($options) ) $this->setData($options); 

		$content = $this->mergeTemplateToLayout([
			'content' => $this->generateTemplateContent()
		]);

		return (new ResponseAction)->output($content);
	}

	public function render ( $template = null, $options = null, $layout = null )
	{	
		if ($this->validCacheAvailable()) {
			$content = $this->getCacheContent();
		} else {
			if ( isset($template) && ! empty($template) ) $this->setTemplate($template);
			if ( isset($layout) && ! empty($layout) ) $this->setLayout($layout);
			if ( isset($options) && ! empty($options) ) $this->setData($options); 

			$content = $this->mergeTemplateToLayout([
				'content' => $this->generateTemplateContent()
			]);

			$this->setCacheContent($content);
		} 
		
		return (new ResponseAction)->output($content);
	}

	protected function validCacheAvailable() 
	{	
		$key = md5($this->route . '--' . $_SERVER['APP_KEY']);
		$file = 'storage/cache/view/' . $key . '.php';
		
		if ($this->filehandler->has($file)) {
			if ( ( time() - $this->getCacheTime() ) < $this->filehandler->getTimestamp($file) ) {
				return true;
			} else {
				$this->filehandler->delete($file);
			}
		}
		return false;
	}

	protected function getCacheContent() 
	{
		$key = md5($this->route . '--' . $_SERVER['APP_KEY']);
		$file = 'storage/cache/view/' . $key . '.php';
		return $this->filehandler->read($file);
	}

	protected function setCacheContent($content) 
	{
		$key = md5($this->route . '--' . $_SERVER['APP_KEY']);
		$file = 'storage/cache/view/' . $key . '.php';
		$this->filehandler->put($file, $content);
	}

	public function setlayout($layout, $module = null) 
	{	
		$module = empty($module) ? $this->getModule() : implode("\\",explode("_",ltrim($module, "App_")));
		$design = $this->basedir . '/' . implode("/", explode('\\', $module ) ) . '/Design';
		if ( !empty($layout) ) $this->layout = $design . '/layouts/' . $layout; 
		return $this;
	}

	protected function getLayout() 
	{
		return $this->layout;
	}

	public function setTemplate($template, $module = null) 
	{	
		$module = empty($module) ? $this->getModule() : implode("\\",explode("_",ltrim($module, "App_")));
		$design = $this->basedir . '/' . implode("/", explode('\\', $module ) ) . '/Design';
		if ( !empty($template) ) $this->template = $design . '/templates/' . $template;
		return $this;
	}

	protected function getTemplate() 
	{
		return $this->template;
	}

	public function setData($data) 
	{	
		if ( !empty($data) ) $this->data = $data; 
		return $this;
	}

	protected function getData() 
	{
		return $this->data;
	}

	public function includeFile($file, $module = null) 
	{	
		if (! empty($file)) {
			if (is_array($file)) {	
				foreach ($file as $i => $include) {
					if ( is_array($include) && count($include) == 2 ) {
						ob_start();
						if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
						$include_file = $this->getIncludeFile($include[0], $include[1]) . $this->getFileExtension();
						if (file_exists($include_file)) require $include_file;
						$includes = ob_get_contents();
						ob_end_clean(); 
						$name = $include[1] . '::' . $include[0] ;
						$this->includes[$name] = $includes;
					} else {
						ob_start();
						if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
						$include_file = $this->getIncludeFile($include) . $this->getFileExtension();
						if (file_exists($include_file)) require $include_file;
						$includes = ob_get_contents();
						ob_end_clean(); 
						$this->includes[$include] = $includes;
					}
				}
			} else {
				ob_start();
				if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
				$include_file = $this->getIncludeFile($file, $module) . $this->getFileExtension();
				if (file_exists($include_file)) require $include_file;
				$includes = ob_get_contents();
				ob_end_clean();
				$name = empty($module) ? $file : $module . '::' . $file;
				$this->includes[$name] = $includes;
			} 
		} 
		return $this;
	}

	protected function getIncludeFile($file, $module = null) 
	{	
		$module = empty($module) ? $this->getModule() : implode("\\",explode("_",ltrim($module, "App_")));
		$design = $this->basedir . '/' . implode("/", explode('\\', $module ) ) . '/Design';
		return $design . '/includes/' . $file;
	}

	protected function getIncludeContent() 
	{
		return [ 'include' => $this->includes ];
	}

	private function generateTemplateContent()
	{
		ob_start(); 
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP);
		extract($this->getIncludeContent(), EXTR_SKIP); 
		require $this->getTemplate() . $this->getFileExtension(); 
		$content = ob_get_contents(); 
		ob_end_clean(); 
		return $content;
	}

	protected function mergeTemplateToLayout($templateContent) 
	{
		ob_start(); 
		extract($templateContent, EXTR_SKIP);
		extract($this->getIncludeContent(), EXTR_SKIP); 
		if (! empty($this->getLayout())) require $this->getLayout() . $this->getFileExtension(); 
		$content = ob_get_contents(); 
		ob_end_clean(); 
		return $content;
	}

	private function getFileExtension() 
	{	
		return '.php'; 
	}

} 