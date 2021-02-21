<?php

namespace App\Module\Main\Module\Controller;

use Symfox\Controller\BaseController;

class HomeController extends BaseController {

	public function index()
	{	
		$data['msg'] = "Hello World! Welcome to Symfox 2.0.1 aka Sunshine";	
		return $this->getResponse()->json($data); 
	} 

	public function contact() 
	{	
		$data = $this->getDB()->table('users')->get();
		return $this->getView()->setLayout('layout_1')->setTemplate('contact')->setData($data)->render();
	}

}