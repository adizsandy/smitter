<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\Calculator;

class HomeController{

	public function index(Request $request){

		return new Response("Hello I am In");
	}

	public function numberGame(Request $request, $number){

		$square = 0; $cube = 0;

		$calculator = new Calculator();
		
		if(isset($number)){
			$square = $calculator->get_square($number);
			$cube = $calculator->get_cube($number);
		}
		
		return new Response("Square : ".$square." and Cube : ".$cube);
	}
}