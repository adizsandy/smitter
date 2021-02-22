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