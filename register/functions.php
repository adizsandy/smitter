<?php

class Fn{

	public function throw($data){
		echo"<pre>";print_r($data);"</pre>";die;
	}
}

return new Fn();