<?php

namespace Boot;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Smitter\Request\RequestAction;
use Symfony\Component\HttpKernel\HttpKernel;
use Smitter\Match\MatchFactoryInterface;

class Kernel extends HttpKernel { 

    private $matcher;

    public function __construct( 
        EventDispatcherInterface $dispatcher, 
        ControllerResolverInterface $control, 
        MatchFactoryInterface $matcher 
    )
    {   
        // Invoke the HTTP Kernel
        parent::__construct( $dispatcher, $control );

        // Set URL Matcher
        $this->matcher = $matcher; 
    }

    public function process ( RequestAction $request )
    {   
        $url_matcher = $this->matcher->getUrlMatcher();  
        $url_matcher->getContext()->fromRequest($request);
        $request->attributes->add($url_matcher->match($request->getPathInfo()));
        
        return $this->handle($request);
    } 
}