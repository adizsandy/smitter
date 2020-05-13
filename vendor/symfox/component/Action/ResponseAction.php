<?php

namespace Symfox\Component\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ResponseAction {

    public $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function output ($content = null, $type = null) 
    {
        if ($type == 'json') {
            $this->response->setContent(json_encode($content));
        } else {
            $this->response->setContent($content);
        }

        $this->setContentType($type);

        return $this->response;
    }

    public function json ($content = null) 
    {
        $this->response->setContent(json_encode($content));
        
        $this->setContentType('json'); 
        
        return $this->response;
    }

    public function redirect($url) 
    {
        $this->response = new RedirectResponse($url);
        return $this->response;
    }

    private function setContentType($type = null) 
    {
        if ($type = 'json') {
            $this->response->headers->set('Content-Type', 'application/json');
        } else if ($type = 'html') {
            $this->response->headers->set('Content-Type', 'text/html');
        } else {
            $this->response->headers->set('Content-Type', 'text/html');
        }
    }
}