<?php

namespace App\Module\Main\Module\Controller;

use App\Module\Main\Module\Model\Test;

class HomeController {

	public function index()
	{
		$test = Test::first();

		$this->session->set('First', $test);

		$name = $test->name; 
		$data['msg'] = "Hello ".$name."! Welcome to Symfox 2.0.1 aka Sunshine";
		
		return $this->response->json($data); 
	}

	public function hashCheck() 
	{	
		dd($this->auth->entity('users')->check());
		$hash = $this->auth->hash('Hello Hi');
		$get = $this->request->query->get('name');
		return $this->response->json($hash . ' ' .$get);
	}

	public function numberGame($number)
	{
		$square = 0; $cube = 0;
		$calculator = new Calculator();
		
		if (isset($number)) {
			$square = $calculator->get_square($number);
			$cube = $calculator->get_cube($number);
		}

		$data['msg'] = "Square : ".$square." and Cube : ".$cube;
		
		return $this->view->layout('layout_1')->render('double_page', $data);
	}	

}