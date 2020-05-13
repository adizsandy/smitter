<?php
/**
 * Symfox : Melting the Rocks of PHP 
 * 
 * @version 0.0.3 | Alfa  
 * @author Shudhansh Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2019 Symfox, All rights reserved
 * @license MIT
 */

namespace Symfox;

use Symfox\Component\Processor\Processor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

 /**  
 * Framework Class
 * Base of framework
 * 
 */
class Framework extends Processor
{   
    public function __construct()
    {   
        parent::__construct();
    }

    public function handle(Request $request)
    {   
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controlProcessor->getResolver()->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $response = $this->controlProcessor->handleRequest($controller, $arguments);

        } catch (\ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $exception) {
            $response = new Response($exception->getMessage(), 500);
        }

        if ( empty($response) ) {
            $response = new Response("Error : No Response Definition Found", 500);
        }

        $this->dispatcher->resolve($request, $response);
        
        return $response;
    }

}