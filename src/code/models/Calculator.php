<?php

namespace App\Model;

class Calculator {

	public function get_square($number){
		return pow($number,2);
	}

	public function get_cube($number){
		return pow($number,3);
	}

}