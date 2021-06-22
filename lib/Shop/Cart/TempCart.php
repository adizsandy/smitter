<?php

namespace Library\Shop\Cart;

use Illuminate\Database\Eloquent\Model;

class TempCart extends Model {

	protected $table = 'temp_cart_masters';

	protected $main_table = 'cart_master';

	public static function add (array $data) 
	{
		$customer_id = customer_id();
		if ( ! empty($customer_id) && isset($data['product_id']) && !empty($data['product_id'])) { 	
			$data = array (
				'customer_id' => $customer_id, 
				'qty' => $data['qty'], 
				'product_id' => $data['product_id'],
				'unit_price' => $data['unit_price'],
				'net_price' => $data['final_price'], 
				'added_on' => date('Y-m-d H:i:s'),
				'added_by' => $customer_id
			);
			$check_cart = TempCart::where(['customer_id' => $customer_id, 'flag' => 0])->get();
			if ( $check_cart->count() == 0 ) {
				return Tempcart::insert($data);
			}  
		}
		return false; 	
	}
}