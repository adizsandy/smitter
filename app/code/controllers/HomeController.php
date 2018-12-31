<?php

namespace App\Controller;

use App\Model\Calculator;
use App\Model\Test;

class HomeController{

	public function index(){
		
		$test = $this->db->table('test')->first();
		
		$name = $test->name;
		$data['msg'] = "Hello ".$name." I am In";
		
		$this->view->render('templates/home',$data);
		
		//return new Response("Hello ".$name." I am In");
	}

	public function numberGame($number){

		$square = 0; $cube = 0;

		$calculator = new Calculator();
		
		if(isset($number)){
			$square = $calculator->get_square($number);
			$cube = $calculator->get_cube($number);
		}
		$this->view->render('templates/double_page',$data);
		//return new Response("Square : ".$square." and Cube : ".$cube);
	}
}