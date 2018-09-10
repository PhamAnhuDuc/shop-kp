<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
class AjaxController extends Controller
{
    //
    public function getAddtoCart($id){
        //return $id;
        $product = Product::find($id);
        Cart::add(['id' => $id, 'name' => $product->name, 
                    'qty' => 1, 'price' =>$product->unit_price, 
                    'price_sale' =>$product->promotion_price, 
                    'options' => ['img' => $product->image]]);
        $total_price = Cart::total();
        $carttotal_product = Cart::count();
        $cart_result = Cart::content();
        return [$cart_result,$carttotal_product,$total_price];
    }

    
}
