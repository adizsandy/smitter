<?php

namespace App\Main\Module\Controller;

class HomeController {

	public function index()
	{	
		$data['title'] = "Symfox - 2.1.2 | Default Home Page";
		return view()->render('home', $data, 'layout_1'); 
	} 

	public function contact() 
	{	
		$data = [  
			'title' => 'Contact page' 
		]; 
		// If post request is submitted to same url/ Contact form is submitted
		if ( request()->isPost() ) { // If POST request recieved
			$token = request()->get('_token'); // value from _token input field, which value is set as: csrf_token('contact')
			if ( auth()->csrfOk('contact', $token) ) { // If valid csrf token is passed
				return response()->json("CSRF Validation Passed");
			} else {
				return response()->json("CSRF Validation failed");
			}
		} 

		// Else render contact form
		return view()->render('contact', $data, 'layout_1');
	}

	public function di() 
	{ 
		return response()->json("Dependency Injection Tested");
	}

	public function focused() 
	{
		return response()->json($users);
	}

}