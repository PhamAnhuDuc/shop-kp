<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
{
    //
    public function getDanhSach(){
    	$customer = Customer::all();
    	return view('admin.Customer.danhsach',['customer'=> $customer]);
    }

    public function getThem(){
    	return view('admin.Customer.them');
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name' => 'required|min:3|max:25',
    			'email'=> 'required|email|unique:customer,email',
    			'address'=>'required|min:3|max:50',
    			'phone_number'=>'required|numeric',
    			'note' => 'required',
    		],
    		[
    			'name.required' => 'name k được rỗng',	
    			'name.min' => 'name độ dài từ 3 đến 25 kí tự',	
    			'name.max' => 'name độ dài từ 3 đến 25 kí tự',	
    			'email.required' => 'email k được rỗng',
    			'email.email' => 'ko đúng định dạng email',
                'email.unique' => 'email đã tồn tại',
    			'address.required' => 'ko đúng định dạng email',
    			'address.min' => 'độ dài từ 3 đến 50 kí tự',
    			'address.max' => 'độ dài từ 3 đến 50 kí tự',
    			'phone_number.required' => 'ko được rỗng',
    			'phone_number.numeric' => 'phải là số',
    			'note.required' => 'không được rỗng',
    		]);
    	$customer = new Customer;
    	$customer->name = $request->name;
        $res = ($request->gender == 1) ? 'nam' : 'nữ';
        $customer->gender = $res;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->note = $request->note;
    	$customer->save();
        return redirect('admin/customer/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $customer = Customer::find($id);
        $valueGender = $customer->gender;
        switch ($valueGender) {
            case "nam":
                $valueGender = 1;
                break;
            case "Nam":
                $valueGender = 1;
                break;
            case "Nữ":
                $valueGender = 0;
                break;
            case "nữ":
                $valueGender = 0;
                break;
                
            default:
                // code...
                break;
        }
        return view('admin.Customer.sua',['customer'=>$customer,'valueGender'=>$valueGender]);
    }

    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'name' => 'required|min:3|max:25',
                //'email'=> 'required|email|unique:customer,email',
                'address'=>'required|min:3|max:50',
                'phone_number'=>'required|numeric',
                'note' => 'required',
            ],
            [
                'name.required' => 'name k được rỗng',  
                'name.min' => 'name độ dài từ 3 đến 25 kí tự',  
                'name.max' => 'name độ dài từ 3 đến 25 kí tự',  
                // 'email.required' => 'email k được rỗng',
                // 'email.email' => 'ko đúng định dạng email',
                // 'email.unique' => 'email đã tồn tại',
                'address.required' => 'address ko đúng định dạng email',
                'address.min' => 'address độ dài từ 3 đến 50 kí tự',
                'address.max' => 'address độ dài từ 3 đến 50 kí tự',
                'phone_number.required' => 'phone_number ko được rỗng',
                'phone_number.numeric' => 'phone_number phải là số',
                'note.required' => ' note không được rỗng',
            ]);
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->note = $request->note;
        $genderPost = "";
        if($request->rdoStatus == 0){
            $genderPost = "Nữ";
        }
        if($request->rdoStatus == 1){
            $genderPost = "Nam";
        }
        $customer->gender =  $genderPost;
        if($request->changeEmail == "on"){
            $this->validate($request,
                [
                   'email'=> 'required|email|unique:customer,email', 
                ],
                [
                    'email.required' => 'email k được rỗng',
                    'email.email' => 'email ko đúng định dạng email',
                    'email.unique' => 'email đã tồn tại',
                ]);
            $customer->email = $request->email;
        }
        $customer->save();
        return redirect('admin/customer/sua/'.$id)->with('thongbao','sua thanh cong');

    }
    public function getXoa($id){
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('admin/customer/danhsach')->with('thongbao','ban xoa thanh cong');
    }

}
