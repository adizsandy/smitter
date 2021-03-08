<?php

namespace Symfox\Dispatch;

use Symfox\Dispatch\Dispatch;

class DispatchFactory {

    private $dispatcher;

    public function __construct()
    {
        $this->dispatcher = new Dispatch;
    }

    public function get() 
    {
        return $this->dispatcher->getDispatcher();
    }

}