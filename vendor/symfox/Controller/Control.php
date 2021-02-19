<?php

namespace Symfox\Controller;

use \stdClass;
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
use \Swift_SendmailTransport;
use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;

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
		$this->controlProvider->db = (new Persistance())->getPersistance();
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
		$this->controlProvider->response = new Response();
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
		$mail_config = $this->registry->getMailTransport();
		switch($mail_config['driver']) {
            case 'sendmail' : 
                $transport = new \Swift_SendmailTransport($mail_config['host'], $mail_config['port']);
                break;
            case 'smtp' :
            default:
                $transport = new \Swift_SmtpTransport($mail_config['host'], $mail_config['port']);
        }
        $transport->setUsername($mail_config['username'])->setPassword($mail_config['password']);
        
        $this->controlProvider->mail = new \stdClass;
        $this->controlProvider->mail->mailer = new \Swift_Mailer($transport);
        $this->controlProvider->mail->composer = new \Swift_Message(); 
	}

} 
