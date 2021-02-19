<?php

namespace Symfox\Controller;

use stdClass;
use App\Registry;
use Symfox\View\View;
use Symfox\Persistance\Persistance; 
use Symfox\Security\Auth;
use Symfox\Response\ResponseAction as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session; 
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class Control {

	private $controlProvider;
	public $basedir; 
	private $registry;

	public function __construct ($dir) 
	{	
		$this->controlProvider = new stdClass();
		$this->basedir = $dir;
		$this->controlProvider->root = $this->basedir . '\\..\\..\\';
		$this->registry = new Registry;
		$this->setPersistanceService(); 
		$this->setSessionService();
		$this->setAuthService();
		$this->setRequestService();
		$this->setResponseService();
		$this->setFileHandlerService();
		$this->setMailerService();
	}

	public function getResolver()
	{
		return new ControllerResolver();
	}

	public function handleRequest($control, $args)
	{	
		// Set View service according to the module
		$this->setViewService($control);
		
		foreach ($this->controlProvider as $key => $service) {
			$control[0]->{$key} = $service;
		}
		return call_user_func_array($control, $args);
	}

	protected function setPersistanceService() 
	{ 	
		$persistance = new Persistance();
		$this->controlProvider->db = $persistance->getPersistance();
	}

	protected function setViewService($controller)
	{ 	
		$path = $this->getRequestService()->getUri();
		$view = new View($controller[0], $this->basedir, $path);
		$this->controlProvider->view = $view;
	}

	protected function setSessionService() 
	{ 	 
		$this->controlProvider->session = new Session();
	}

	protected function setResponseService() 
	{	
		$response = new Response();
		$this->controlProvider->response = $response;
	}

	protected function setAuthService() 
	{
		$this->controlProvider->auth = new Auth;
	}

	protected function setRequestService() 
	{
		$this->controlProvider->request = Request::createFromGlobals();
	}

	protected function getRequestService() 
	{
		return $this->controlProvider->request;
	}

	protected function setFileHandlerService() 
	{	
		$adapter = new Local($this->controlProvider->root);
		$this->controlProvider->filehandler = new Filesystem($adapter); 
	}

	protected function setMailerService() 
	{
		$this->controlProvider->mail = $this->registry->getMailTransport();
	}

} 
