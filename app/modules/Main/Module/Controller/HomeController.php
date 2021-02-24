<?php

namespace App\Module\Main\Module\Controller;

use Symfox\Controller\BaseController;

class HomeController extends BaseController {

	public function index()
	{	
		$data['msg'] = "Hello World! Welcome to Symfox 2.1.1 aka Sunshine";	
		return $this->getResponse()->getJson($data); 
	} 

	public function contact() 
	{	
		//Set cache false for highly dynamic pages ->setCache(false)
		$data = [ 'data' => $this->getDB()->table('users')->get() ];
		return $this->getView()->render('contact', $data, 'layout_1');
	}

}