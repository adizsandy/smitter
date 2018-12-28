<?php

namespace Symfox;

use Symfox\Component\Processor\Processor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $exception) {
            $response = new Response($exception->getMessage(), 500);
        }

        $this->dispatcher->resolve($request, $response);

        return $response;
    }

}