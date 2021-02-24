<?php

namespace Boot;

use Symfox\Match\Matche;
use Symfox\Dispatch\Dispatch;
use Symfox\Controller\Control;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel { 

    public function __construct()
    { 
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
}