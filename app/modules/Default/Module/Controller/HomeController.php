<?php

namespace App\Main\Controller;

use \App\Module\Default\Module\Model\Test;
use App\Service\Authentication\Auth;

class HomeController {

	public function index()
	{	
		$test = Test::first();

		$this->session->set('First', $test);

		$name = $test->name; 
		$data['msg'] = "Hello ".$name." I am In";
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