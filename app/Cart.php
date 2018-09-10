<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0; //tổng phần tử
	public $totalPrice = 0; //tổng giá

	public function __construct($oldCart){ //khởi tạo 1 giỏ hàng
		if($oldCart){
			//$this->items = $oldCart->items;
			//$this->totalQty = $oldCart->totalQty;
			//$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		// dd($this->items);
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];
		// if($this->items){
		// 	if(array_key_exists($id, $this->items)){  //kiem tra key co ton tai trong arr hay ko
		// 		$giohang = $this->items[$id];
		// 	}
		// }
		
		
		$giohang['qty']++;
		$giohang['price'] = $item->unit_price * $giohang['qty'];
		$item1[$id] = $giohang;
		// $this->items[$id] = $giohang;
		$qty = $this->totalQty +1;
		
		$price = $this->totalPrice += $item->unit_price;
		//return $this->items;
		return compact("item1","qty","price");

	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
