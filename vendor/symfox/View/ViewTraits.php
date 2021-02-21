<?php

namespace Symfox\View;

use Symfox\Security\Auth;
use Symfox\Filehandler\Filehandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

trait ViewTraits {

    public $session; 
	public $auth; 
    protected $filehandler;

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
}