<?php

namespace App\Module\Main\Module\Controller;

class HomeController {

	public function index()
	{	
		$data['title'] = "Symfox - 2.1.2 | Default Home Page";
		return view()->render('home', $data, 'layout_1'); 
	} 

	public function contact() 
	{	
		//Set cache false for highly dynamic pages ->setCache(false)
		// db()->connection('db2') syntax is used to connect with other DB configurations than `default`
		// DB configurations are managed from ~/config/database.php
		//$data = [  'title' => 'Contact page', 'data' => db()->connection('db2')->table('users')->get() ];
		
		$data = [  'title' => 'Contact page', 'data' => db()->table('users')->get() ];
		return view()->render('contact', $data, 'layout_1');
	}

	public function di() 
	{ 
		return response()->getJson("Dependency Injection Tested");
	}

}