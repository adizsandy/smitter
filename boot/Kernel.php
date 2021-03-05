<?php

namespace Boot;

use Boot\Env\Environment;
use Symfony\Component\Dotenv\Dotenv;
use Symfox\Match\Matche;
use Symfox\Dispatch\Dispatch;
use Symfox\Controller\Control;
use Symfox\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel { 

    private $container;

    public function __construct()
    {   
        // Bootstrap the Environment
        $this->bootEnvironment();

        // Bootstrap the Service Container
        $this->bootContainer();

        // Invoke the HTTP Kernel
        parent::__construct( $this->getDispatcher(), $this->getControlResolver() );  
    }

    public function process (Request $request)
    {   
        $this->getMatcher()->getContext()->fromRequest($request);
        $request->attributes->add($this->getMatcher()->match($request->getPathInfo()));
        
        return $this->handle($request);
    }

    public function getMatcher() 
    {
        return ( new Matche() )->getMatcher();
    }

    public function getDispatcher() 
    {
        return ( new Dispatch() )->getDispatcher();
    }

    public function getControlResolver() 
    {
        return ( new Control() )->getResolver();
    }

    public function getContainer() 
    {
        return $this->container;
    }

    private function bootContainer() 
    {
        $this->container = new Container;
        $bindings = require 'container/Service.php';
        if (count($bindings) > 0) {
            foreach ($bindings as $id => $service) {
                $this->container->set($id, new $service());
            }
        }
    }

    private function bootEnvironment() 
    {
        // Load all environment variables
        (new Dotenv())->bootEnv(__DIR__.'/../.env');

        // Set Environment
        Environment::set($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);
    }
}