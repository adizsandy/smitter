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
		$hash = $this->auth->hash('Hello Hi');
		$get = $this->request->query->get('name');

		return $this->response->json($hash . ' ' .$get);
	}

	public function numberGame($number)
	{
		$square = 0; $cube = 0;  
		$data['msg'] = "Square : ".$square." and Cube : ".$cube; 

		return $this->view 
			// Set layout from different module
			->setLayout('layout_1', 'App_Main_Module2') 
			// Set template from different module
			->setTemplate('double_page', 'App_Shashank_ERP01') 
			// Include file from different modules 
			->includeFile([ ['header/mini_header', 'App_Main_Module'], 'nav/main_nav', 'extra/big_desc' ])
			->setData($data)
			->render(); 

		//return $this->view->setLayout('layout_1')->setTemplate('double_page')->setData($data)->render();
	}	

}