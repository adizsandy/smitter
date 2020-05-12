<?php

namespace App\Controller;

use App\Model\Calculator;
use App\Model\Test;

class HomeController{

	public function index(){
		
		$test = Test::first();
		
		$name = $test->name; 
		$data['msg'] = "Hello ".$name." I am In";
		
		return $this->view->render('templates/home',$data);
	}

	public function numberGame($number){

		$square = 0; $cube = 0;

		$calculator = new Calculator();
		
		if(isset($number)){
			$square = $calculator->get_square($number);
			$cube = $calculator->get_cube($number);
		}

		$data['msg'] = "Square : ".$square." and Cube : ".$cube;

		return $this->view->render('templates/double_page',$data);
	}
}