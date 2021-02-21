<?php

namespace Symfox\Controller;

use Symfox\View\View;
use Symfox\Persistance\Persistance; 
use Symfox\Security\Auth;
use Symfox\Response\ResponseAction as Response;
use Symfox\Mail\Mailer;
use Symfox\Filehandler\Filehandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;  

abstract class BaseController {

    private $db;
    private $view;
    private $session;
    private $response;
    private $auth;
    private $request;
    private $filehandler;
    private $mailer;

    public function getDB() 
	{   
        if (empty($this->db) ) {
            $this->setPersistanceService(); 
        } 
		return $this->db;
	}

	protected function setPersistanceService() 
	{ 	 
		$this->db = (new Persistance())->getPersistance();
	}

    public function getView() 
    {
        if (empty($this->view)) {
            $this->setViewService();
        }
        return $this->view;
    }

	protected function setViewService()
	{ 	 
		$this->view = new View(); 
	}

    public function getSession() 
    {   
        if (empty($this->session)) {
            $this->setSessionService();
        } 
        return $this->session;
    }

	protected function setSessionService() 
	{ 	 
		$this->session = new Session();
	}

    public function getResponse() 
    {
        if (empty($this->response)) {
            $this->setResponseService();
        }
        return $this->response;
    }

	protected function setResponseService() 
	{	 
		$this->response = new Response();
	}

    public function getAuth() 
    {
        if (empty($this->auth)) {
            $this->setAuthService();
        }
        return $this->auth;
    }

	protected function setAuthService() 
	{
		$this->auth = new Auth;
	}

    public function getRequest() 
    {   
        if (empty($this->request)) {
            $this->setRequestService();
        }
        return $this->request;
    }

	protected function setRequestService() 
	{
		$this->request = Request::createFromGlobals();
	}

    public function getFileHandler() 
    {   
        if (empty($this->filehandler)) {
            $this->setFileHandlerService();
        } 
        return $this->filehandler;
    }

	protected function setFileHandlerService() 
	{	
		$this->filehandler = (new Filehandler())->getHandler();
	}

    public function getMailer() 
    {
        if (empty($this->mailer)) {
            $this->setMailerService();
        }
        return $this->mailer;
    }

	protected function setMailerService() 
	{	
        $this->mailer = ( new Mailer())->getMailer();
	}

}