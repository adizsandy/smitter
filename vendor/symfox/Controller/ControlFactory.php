<?php

namespace Symfox\Controller;

use Symfox\Controller\Control;

class ControlFactory {

    private $control;

    public function __construct()
    {
        $this->control = new Control;
    }

    public function get() 
    {
        return $this->control->getResolver();
    }

}