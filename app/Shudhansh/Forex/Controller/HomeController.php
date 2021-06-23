<?php

namespace App\Shudhansh\Forex\Controller;

class HomeController {

    public function index() 
    {
        return response()->json("Welcome to Forex Module");
    }
}