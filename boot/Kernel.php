<?php

namespace Boot;

use Symfox\Request\RequestAction;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfox\Container\Container;

class Kernel extends HttpKernel { 

    private $container;

    public function __construct(Container $container)
    {   
        // Set the Service Container
        $this->container = $container;  

        // Invoke the HTTP Kernel
        parent::__construct( $this->container->get('dispatcher'), $this->container->get('control') );  
    }

    public function process (RequestAction $request)
    {   
        $url_matcher = ( $this->container->get('matcher') )->getUrlMatcher();  
        $url_matcher->getContext()->fromRequest($request);
        $request->attributes->add($url_matcher->match($request->getPathInfo()));
        
        return $this->handle($request);
    } 
}