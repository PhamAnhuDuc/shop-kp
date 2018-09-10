<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
class ProductTypeController extends Controller
{
    public function getDanhSach(){
    	$productType = ProductType::all();
    	return view('admin.ProductType.danhsach',['productType'=>$productType]);
    }

    public function getThem(){
        $productType = ProductType::all();
    	return view('admin.ProductType.them',['productType'=>$productType]);
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name' => 'required|min:3|max:20',
    			'description' => 'required|min:5|max:50',

    		],
    		[
    			'name.required' => 'name không được rỗng',
    			'name.min'=> 'độ dài từ 3 đến 20 kí tự',
    			'name.max'=> 'độ dài từ 3 đến 20 kí tự',
    			'description.required' => 'phần miêu tả k được rỗng',
    			'description.min'=> 'độ dài từ 5 đến 50 kí tự',
    			'description.max'=> 'độ dài từ 5 đến 50 kí tự',
    		]);

    	$productType = new ProductType;
    	$productType->name = $request->name;
    	$productType->description = $request->description;
    	if($request->hasFile('img')){ //ckeck có file này hay ko
    		$file = $request->file('img'); //lấy tên file
    		$duoi = $file->getClientOriginalExtension();//lấy ra phần đuôi mở rộng
    		if($duoi !=='jpg' && $duoi !=='png' && $duoi !=='jpeg'){
    			return redirect('admin/producttype/them')->with('thongbao','Bạn chỉ được chọn ảnh có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();//lay ten ban dau cua cai hinh
    		$nameNew = str_random(4)."_".$name; //tranh ten trung nhau
    		while (file_exists("source/image/product/".$nameNew)) {
    		    $nameNew = str_random(4)."_".$name; //tranh ten trung nhau
    		}
    		$file->move("source/image/product",$nameNew); // thuc hien luu hinh vao thu muc
            $productType->image = $nameNew;
    	}else{
    		$productType->image = '';
    	}
    	$productType->save();
    	return redirect('admin/producttype/them')->with('thongbao','them thanh cong');
    }

    public function getSua($id){
    	$productType = ProductType::find($id);
    	return view('admin.ProductType.sua',['productType' => $productType]);
    }
    public function postSua(Request $request,$id){
    	$this->validate($request, 
    		[
    			'name' => 'required|min:3|max:20',
    			'description' => 'required|min:5|max:50',

    		],
    		[
    			'name.required' => 'name không được rỗng',
    			'name.min'=> 'độ dài từ 3 đến 20 kí tự',
    			'name.max'=> 'độ dài từ 3 đến 20 kí tự',
    			'description.required' => 'phần miêu tả k được rỗng',
    			'description.min'=> 'độ dài từ 5 đến 50 kí tự',
    			'description.max'=> 'độ dài từ 5 đến 50 kí tự',
    		]);
    		$productType = ProductType::find($id);
    		$productType->name = $request->name;
    		$productType->description = $request->description;
    		//kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('img')){
            $file = $request->file('img');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/producttype/them')-> with('thongbao','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
            $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            //unlink("source/image/product/".$productType->image);// xóa cái hình cũ rồi thêm 
            $file->move("source/image/product/",$Hinh); // thuc hien luu hinh vao thu muc
            $productType->image = $Hinh;
        }else {
           
        }
        $productType->save();
        return redirect('admin/producttype/sua/'.$id)->with('thongbao','Ban da sửa slide thanh cong');
    }

    public function getXoa($id){
    	$productType = ProductType::find($id);
    	$productType->delete();
    	return redirect('admin/producttype/danhsach')->with('thongbao','da xoa thanh cong');
    }
}
