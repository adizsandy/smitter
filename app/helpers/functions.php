<?php

if (! function_exists('dd')) {
	function dd(...$data) {
		echo '<pre>';  print_r($data); echo '</pre>'; die;
	}
} 

if (! function_exists('site_url')) {
	function site_url() {
		return $_SERVER['APP_URL'];
	}
}

if (! function_exists('customer_id')) {
	function customer_id (){  
	    if ( auth()->entity('customers')->check() ){
	        $customer_id = auth()->entity('customers')->data()->id;
	        session()->put('customer_id', $customer_id);  
	    } else {
	        $customer_id = session()->get('customer_id');
	        if(empty($customer_id)){
	            $customer_id = session()->getId();
	            session()->put('customer_id', $customer_id);      
	        }            
	    }  
	    return $customer_id; 
	}
} 