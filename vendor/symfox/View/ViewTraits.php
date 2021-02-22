<?php

namespace Symfox\View;

use Symfox\Security\Auth;
use Symfox\Filehandler\Filehandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Boot\Env\Configurator;

trait ViewTraits {

    public $session; 
	public $auth; 
    protected $filehandler;
	protected $module;

    protected function setAuthService() 
	{
		$this->auth = new Auth;
	}

    protected function setFileHandleService() 
	{ 
		$this->filehandler = (new Filehandler)->getHandler();
	}

	protected function setSessionService() 
	{	 
		$this->session = new Session();
	}

    protected function getRequest() 
	{
		return Request::createFromGlobals();
	}

	protected function setModuleDir($module = null) 
	{
		if (empty($module)) { // Current Request Module
			$module = Configurator::getRouteCollection($this->getRequest()->getPathInfo()); 
		}  
		$this->module = Configurator::getModuleDir() . implode("/",explode("_", ltrim($module, 'App_')));
	}

	protected function getModuleDir() 
	{
		return $this->module;
	}

	protected function getCacheKey() 
	{
		return md5($this->getRequest()->getPathInfo() . ':' . Configurator::getAppKey());
	}
}