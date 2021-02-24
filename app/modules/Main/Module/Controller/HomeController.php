<?php

namespace App\Module\Main\Module\Controller;

use Symfox\Controller\BaseController;

class HomeController extends BaseController {

	public function index()
	{	
		$data['title'] = "Symfox - 2.1.2 | Default Home Page";
		return $this->getView()->render('home', $data, 'layout_1'); 
	} 

	public function contact() 
	{	
		//Set cache false for highly dynamic pages ->setCache(false)
		$data = [  'title' => 'Contact page', 'data' => $this->getDB()->table('users')->get() ];
		return $this->getView()->render('contact', $data, 'layout_1');
	}

}