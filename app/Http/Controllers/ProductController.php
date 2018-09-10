<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
class ProductController extends Controller
{
    //
    public function getDanhSach(){
    	$product = Product::all();
    	return view('admin.Product.danhsach',['product' => $product]);
    }

    public function getThem(){
        $productType = ProductType::all();
    	return view('admin.Product.them',['productType'=>$productType]);
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name' => 'required|unique:products,name|min:3|max:20',
    			// 'id_type' => 'required|numeric|min:0|max:10',
                'TheLoai'=>'required',
    			'description'=> 'required|min:3|max:50',
    			'unit_price'=> 'required|numeric|min:0|max:500000',
    			'promotion_price'=> 'required|numeric|min:0|max:500000',
    		],
    		[
    			'name.required' => 'name ko được rỗng',
                'name.unique' => 'ten sp đã tồn tại',
    			'name.min' => 'name độ dài từ 3 đến 20 kí tự',
    			'name.max' => 'name độ dài từ 3 đến 20 kí tự',
                'TheLoai.required'=> 'The loai ko dc rong',
    			// 'id_type.required' => 'id_type không được rỗng',
    			// 'id_type.numeric' => 'id_type phải là số',
    			// 'id_type.min' => 'id_type min từ 0 đến 10',
    			// 'id_type.max' => 'id_type min từ 0 đến 10',

    			'description.required' => 'description không được rỗng',
    			'description.min' => 'description min từ 3 đến 50 Kí tự',
    			'description.max' => 'description min từ 3 đến 50 Kí tự',	

    			'unit_price.required' => 'unit_price không được rỗng',
    			'unit_price.numeric' => 'unit_price phải là số',
    			'unit_price.min' => 'unit_price min từ 0 đến 500000',
    			'unit_price.max' => 'unit_price min từ 0 đến 500000',
	

    			'promotion_price.required' => 'promotion_price không được rỗng',
    			'promotion_price.numeric' => 'promotion_price phải là số',
    			'promotion_price.min' => 'promotion_price min từ 0 đến 500000',
    			'promotion_price.max' => 'promotion_price min từ 0 đến 500000',
    		]
    	);
    	$product = new Product;
    	$product->name = $request->name;
    	$product->id_type = $request->TheLoai;
    	$product->description = $request->description;
    	$product->unit_price = $request->unit_price;
    	$product->promotion_price = $request->promotion_price;
    	$product->unit = $request->unit;
    	//dd($request->hasFile('img'));

    	if($request->hasFile('img')){ //ckeck có file này hay ko
    		$file = $request->file('img'); //lấy tên file
    		$duoi = $file->getClientOriginalExtension();//lấy ra phần đuôi mở rộng
    		if($duoi !=='jpg' && $duoi !=='png' && $duoi !=='jpeg'){
    			return redirect('admin/product/them')->with('thongbao','Bạn chỉ được chọn ảnh có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();//lay ten ban dau cua cai hinh
    		$nameNew = str_random(4)."_".$name; //tranh ten trung nhau
    		while (file_exists("source/image/product/".$nameNew)) {
    		    $nameNew = str_random(4)."_".$name; //tranh ten trung nhau
    		}
    		$file->move("source/image/product",$nameNew); // thuc hien luu hinh vao thu muc
            $product->image = $nameNew;
    	}else{
    		$product->image = '';
    	}
    	$product->save();
    	return redirect('admin/product/them')->with('thongbao','them thanh cong');
    }

    public function getSua($id){
        $productType = ProductType::all();
    	$product = Product::find($id);
    	return view('admin.Product.sua',['product'=>$product,'productType'=>$productType]);
    }

    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'name' => 'required|min:3|max:20',
                // 'id_type' => 'required|numeric|min:0|max:10',
                'description'=> 'required|min:3|max:50',
                'unit_price'=> 'required|numeric|min:0|max:500000',
                'promotion_price'=> 'required|numeric|min:0|max:500000',
            ],
            [
                'name.required' => 'name ko được rỗng',
                'name.min' => 'name độ dài từ 3 đến 20 kí tự',
                'name.max' => 'name độ dài từ 3 đến 20 kí tự',
                // 'id_type.required' => 'id_type không được rỗng',
                // 'id_type.numeric' => 'id_type phải là số',
                // 'id_type.min' => 'id_type min từ 0 đến 10',
                // 'id_type.max' => 'id_type min từ 0 đến 10',

                'description.required' => 'description không được rỗng',
                'description.min' => 'description min từ 3 đến 50 Kí tự',
                'description.max' => 'description min từ 3 đến 50 Kí tự',   
                'TheLoai.required'=> 'The loai ko dc rong',

                'unit_price.required' => 'unit_price không được rỗng',
                'unit_price.numeric' => 'unit_price phải là số',
                'unit_price.min' => 'unit_price min từ 0 đến 500000',
                'unit_price.max' => 'unit_price min từ 0 đến 500000',
    

                'promotion_price.required' => 'promotion_price không được rỗng',
                'promotion_price.numeric' => 'promotion_price phải là số',
                'promotion_price.min' => 'promotion_price min từ 0 đến 500000',
                'promotion_price.max' => 'promotion_price min từ 0 đến 500000',
            ]
        );
        $product = Product::find($id);
        $product->name = $request->name;
        $product->id_type = $request->TheLoai;
        //$product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->unit = $request->unit;

        if($request->hasFile('img')){ //ckeck có file này hay ko
            $file = $request->file('img'); //lấy tên file
            $duoi = $file->getClientOriginalExtension();//lấy ra phần đuôi mở rộng
            if($duoi !=='jpg' && $duoi !=='png' && $duoi !=='jpeg'){
                return redirect('admin/product/sua')->with('thongbao','Bạn chỉ được chọn ảnh có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();//lay ten ban dau cua cai hinh
            $nameNew = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("source/image/product/".$nameNew)) {
                $nameNew = str_random(4)."_".$name; //tranh ten trung nhau
            }
            $file->move("source/image/product",$nameNew); // thuc hien luu hinh vao thu muc
            $product->image = $nameNew;
        }

        $product->save();
        return redirect('admin/product/sua/'.$id)->with('thongbao','sua thanh cong');
    }

    public function getXoa($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/product/danhsach')->with('thongbao','xoa thanh cong');
    }
}
