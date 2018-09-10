<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Customer;
class BillController extends Controller
{
    //
    public function getDanhSach(){
    	$bill = Bill::all();
    	return view('admin.Bill.danhsach',compact('bill'));
    }

    public function getThem(){
    	return view('admin.Bill.them');
    }
    public function postThem(Request $request){
    }
    public function getSua($id){
    }

    public function postSua(Request $request, $id){
    }
    public function getXoa($id){
    }

}