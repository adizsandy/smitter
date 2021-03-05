<?php

namespace Symfox\Request;

use Symfony\Component\HttpFoundation\Request;

class RequestAction extends Request {

    public function allPost() 
    {
        return $this->request->all();
    }

    public function allQuery() 
    {
        return $this->query->all();
    }

    public function allCookie() 
    {
        return $this->cookies->all();
    }

    public function allFiles() 
    {
        return $this->files;
    }

}