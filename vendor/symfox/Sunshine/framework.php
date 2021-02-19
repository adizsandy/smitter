<?php

namespace Symfox\Sunshine;

use Symfox\Processor\Processor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**  
 * Framework Class
 * Base of framework
 * 
 */
class Framework extends Processor
{   
    public function handle(Request $request)
    {   
        $this->getMatcher()->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->getMatcher()->match($request->getPathInfo()));
            
            $controller = $this->getControlProcessor()->getResolver()->getController($request);
            $arguments = $this->getArgumentResolver()->getArguments($request, $controller);
            
            $response = $this->getControlProcessor()->handleRequest($controller, $arguments);

        } catch (\ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $exception) {
            $response = new Response($exception->getMessage(), 500);
        }

        if ( empty($response) ) {
            $response = new Response("Error : No Response Definition Found", 500);
        }

        $this->getDispatcher()->resolve($request, $response);
        
        return $response;
    }

}