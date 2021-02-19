<?php

namespace App\Module\Main\Module\Controller;

class HomeController {

	// HELPER SERVICES INBUILT IN CONTROLLER
	// $this->root ( project root folder )
	// $this->mail ( For sending mail ) Swiftmailer/Swiftmailer
	// $this->filehandler ( For file handling processes ) League/Flysystem
	// $this->request ( For request parameters ) Symfony/Http-Foundation/Request
	// $this->auth ( For authentication processes ) Symfony/Security 
	// $this->session ( For handling session ) Symfony/Session;
	// $this->view ( For rendering views / preparing view content ) Symfox/View ( Custom )
	// $this->db ( For handling DB queries ) Laravel/Eloquent/QueryBuilder 
	// $this->response ( For rendering response ) Symfox/Response -> Symfony/Response
	// $this->response->pdf($html_content); Symfox/Response -> Dompdf/Dompdf
	// $this->response->csv($collection, $structure) Symfox
	// $this->response->excel($collection, $structure) Symfox

	public function index()
	{	
		$data['msg'] = "Hello World! Welcome to Symfox 2.0.1 aka Sunshine";	
		return $this->response->json($data); 
	} 

}