<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use File;
use Carbon\Carbon;
class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.Slider.danhsach',['slide'=>$slide]);
    }

    

    public function getThem(){
    	return view('admin.Slider.them');
    }

    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'link' => 'required|min:3|max:20',
    		],
    		[
    			'link.required' => 'Bạn chưa nhập tên',
    			'link.min' => 'độ dài không hợp lệ',
    			'link.max' => 'độ dài không hợp lệ',
    		]
    	);
    	$slide = new Slide;
    	$slide->link = $request->link;
    	 //kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension(); //lay ra phan duoi mo rong
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/slide/them')-> with('thongbao','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
            $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("source/image/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            $file->move("source/image/slide",$Hinh); // thuc hien luu hinh vao thu muc
            $slide->image = $Hinh;
        }else{
        	$slide->image = '';
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','them thanh cong');
    }


    //thực hiện xóa 
    public function getXoa($id){
        $slide = Slide::find($id);
        $slide-> delete();
        return redirect('admin/slide/danhsach')->with('thongbao','da xoa thanh cong');
        
    }
    // thực hiện sửa tìm và đổ dữ liệu sang bên form
    public function getSua($id){
    	// $path = public_path('source/image/slide/RXFA_1.png'); //su dung ham nay de check duong dan
    	// File::delete($path);
    	// //echo($path);
    	// die();
    	// $images = File::allFiles("image/slide/RXFA_1.png");
    	// $images->getPathname();
    	// echo($images);
    	// die();
    	// //$a = "shop/public/source/image/slide/RXFA_1.png";
    	// dd(scandir("shop/public/source/image/slide/RXFA_1.png"));
    	//dd($a->getPathname());
    	// echo dir("public/source/image/slide/RXFA_1.png");
    	// die();
    	// File::delete("public/source/image/slide/RXFA_1.png");
    	//rmdir("http://localhost:8080/framewok/shop/public/source/image/slide/RXFA_1.png");
    	//dd(getRealPath('public/source/image/slide/RXFA_1.png'));
        $slide = Slide::find($id);
        return view('admin.Slider.sua',['slide' => $slide]);
    }
    // ấn nút sủa thì nó nhẩy sang router này nhận dữ liệu từ form về  kèm theo cái id nữa
    public function postSua(Request $request ,$id){
    	$this->validate($request,
    		[
    			'link' => 'required|min:3|max:20',
    		],
    		[
    			'link.required' => 'Bạn chưa nhập tên',
    			'link.min' => 'độ dài không hợp lệ',
    			'link.max' => 'độ dài không hợp lệ',
    		]
    	);
    	$slide = Slide::find($id);
    	// dd($slide);
    	$slide->link = $request->link;
    	 //kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){ //nếu có biến hình
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension(); //lay ra phan duoi mo rong
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/slide/them')-> with('loi','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
            $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("source/image/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            //echo($file->getRealPath($file));

            //unlink("source/image/slide/".$slide->image); // khi sửa thì cần xóa cái hình cũ đi rồi mới thêm hình mới vào
            // $path = public_path('source/image/slide/'.$slide->image);
            // File::delete($path);
            $file->move("source/image/slide",$Hinh); // thuc hien luu hinh vao thu muc
            $slide->created_at = Carbon::now();
            $slide->updated_at = Carbon::now();
            $slide->image = $Hinh;
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','sua thanh cong');
    }
}

