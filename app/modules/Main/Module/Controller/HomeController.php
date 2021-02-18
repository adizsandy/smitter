<?php

namespace App\Module\Main\Module\Controller;

use App\Module\Main\Module\Model\User;
use App\Module\Main\Module\Model\Test;

class HomeController {

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
		try {
			$square = 0; $cube = 0;  
			$data['msg'] = "Square : ".$square." and Cube : ".$cube; 

			// Get HTML for pdf generation
			$html_content = $this->view->setLayout('layout_1', 'App_Main_Module2')->setTemplate('double_page', 'App_Main_Module2')->setData($data)->render();

			// Generate PDF
			$pdf_content = $this->response->pdf($html_content);
			$pdf_file_name = 'public/uploads/pdf/'.md5("randompdfname") .'.pdf'; 
			
			$this->filehandler->put($pdf_file_name, $pdf_content); // Upload the generated pdf

			// Generate CSV
			$collection = User::where(['flag' => 0])->get(); // get user data
			$structure = [ 
				[ 'S.No.', 'Email', 'Password', 'Created At' ] // labels
				[ '__i', 'email', 'password', 'created_at' ] // table column_name
			]; 
			$csv_content = $this->response->csv($collection, $structure); // Generate csv 
			$csv_file_name = 'public/uploads/csv/'. md5("randomcsvname") .'.csv'; // Custom path + name for csv upload
			
			$this->filehandler->put($csv_file_name, $csv_content); // Upload the generated csv
			//return $this->filehandler->read($csv_file_name); // Export/Download the csv

			// Send EMail
			// $this->mail->composer // For preparing mail content
			// $this->mail->mailer // For sending mail
			$mail_content = $this->mail->composer
				->setSubject("ABC")
				->setTo("abc@gmail.com")
				->setFrom("dhuryt@gmail.com")
				->setBody($html_content)
				->attach(Swift_Attachment::fromPath($this->root . $csv_file_name));
				->attach(Swift_Attachment::fromPath($this->root . $pdf_file_name));

			$this->mail->mailer->send($mail_content);

			// Render some success view
			return $this->view->setLayout('layout_1', 'App_Main_Module2')->setTemplate('double_page', 'App_Main_Module2')->setData($data)->render();

		} catch (\Exception $e) {
			return $this->response->json(['success' => false, 'message' => $e->getMessage()]);
		} 
	}	

}