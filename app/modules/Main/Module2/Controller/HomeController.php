<?php

namespace App\Module\Main\Module2\Controller;

use App\Module\Main\Module2\Service\Calculator;
use App\Module\Main\Module2\Model\Test2;

class HomeController {

	public function index()
	{	
		$test = Test2::first();

		$this->session->set('First', $test);

		$name = $test->name; 
		$data['msg'] = "Hello ".$name." I am In";
		$data['more'] = "hi";
		
		return $this->response->json($data); 
	}

	public function numberGame($number)
	{
		$square = 0; $cube = 0;
		$calculator = new Calculator();
		
		if(isset($number)){
			$square = $calculator->get_square($number);
			$cube = $calculator->get_cube($number);
		}

		$data['msg'] = "Square : ".$square." and Cube : ".$cube;
		
		return $this->view->layout('layout_1')->render('double_page', $data);
	}	
}