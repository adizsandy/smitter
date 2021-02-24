<?php

namespace Boot;

use Symfox\Processor\Processor;
use Symfony\Component\HttpFoundation\Request; 

class Kernel {

    private $processor;

    public function __construct($env = 'local', $debug = true)
    {
        $this->processor = new Processor($env, $debug);
    }

    public function handle (Request $request)
    {   
        $this->processor->getMatcher()->getContext()->fromRequest($request);
        $request->attributes->add($this->processor->getMatcher()->match($request->getPathInfo()));
        
        return $this->processor->handle($request);
    }

    public function finish($request, $response) 
    {
        $this->processor->terminate($request, $response);
    }
}