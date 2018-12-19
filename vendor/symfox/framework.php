<?php

namespace Symfox;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Framework implements HttpKernelInterface
{   
    private $dispatcher;
    private $events;
    private $listeners;
    private $matcher;
    private $controllerResolver;
    private $argumentResolver;

    public function __construct($events, $listeners, UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {   
        $this->dispatcher = new EventDispatcher();
        $this->events = $events;
        $this->listeners = $listeners;
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;

    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);//echo"<pre>";print_r($controller);die;
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $exception) {
            $response = new Response('An error occurred', 500);
        }

        if(!empty($this->events)){
            foreach($this->events as $e_name => $event){
                if(!empty($this->listeners[$e_name])){
                    foreach($this->listeners[$e_name] as $l_name => $listener){
                        $this->dispatcher->addSubscriber(new $listener());
                    }
                    $this->dispatcher->dispatch($name, new $event($response, $request));
                } 
            }
        }

        return $response;
    }


}