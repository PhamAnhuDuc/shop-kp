<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Customer;
use App\Bill;
use App\User;
use App\BillDetail;
use Carbon\Carbon;
use Cart;
use Session;
use Hash;
use Auth;
use Mail;
class PageController extends Controller
{
   
    public  function getIndex(Request $req){
        if($req->ajax || 'NULL'){
            $slide = Slide::take(2)->get(); //lấy ra tất cả cái side ở model
            $new_product = Product::where('new',1)->paginate(4);
            $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
            return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
        }
    }

    //$type để cho biết nó là loại sản phẩm nào
    public function getLoaisanpham($type){
        $sp_theoloai = Product::where('id_type',$type)->get(); //laays ra sp theo loai
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3); //lay ra sp khac
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
        return view('pages.loaisanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitietsanpham(Request $req){
        $san_pham  = Product::where('id',$req->id)->first();
        $san_pham_tuongtu = Product::where('id_type',$san_pham->id_type)->paginate(6);
        return view('pages.chitiet_sanpham',compact('san_pham','san_pham_tuongtu'));
    }

    public function getLienhe(){
        //$this->middleware('only_activated_user');
        return view('pages.lienhe');
    }
    public function postLienhe(Request $req){
    }

    public function getGioithieu(){
        return view('pages.gioithieu');
    }

    public function getAddtoCart($id){
        $product = Product::find($id);
        Cart::add(['id' => $id, 'name' => $product->name, 
                    'qty' => 1, 'price' =>$product->unit_price, 
                    'price_sale' =>$product->promotion_price, 
                    'options' => ['img' => $product->image]]);
        return redirect()->back(); //trở về view ban đầu
    }

    public function getDelItemCart($rowId){
        
        Cart::remove($rowId);
        return back();
    }


    public function getDatHang(){
      
        return view('pages.dathang');
    }

    public function postDatHang(Request $req){
        $customer = new Customer; 
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->adress;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save(); //luu thong tin khac hang

        




        $bill = new Bill; //luu hoa don
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
         
        $bill->total = (float)str_replace(',','',Cart::total());
        
        $bill->payment = $req->payment;
        $bill->note = $req->notes;
        $bill->save();
        //luu chi tiet hoa don - sẽ có nhiều số lượng => dùng for each để lưu => để hạn chế query nhiều lần dùng cách dưới đây
        $insert=[];
        foreach (Cart::content() as $key => $value) {
            $nameProduct[] = $value->name;
            $quantity[]      = $value->qty;
            $unit_price[]    = $value->price;
            $insert[]=[
                'id_bill' => $bill->id,
                'id_product' =>  $value->id,
                'quantity' => $value->qty,
                'unit_price' => $value->price,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ];
        }
        //dd($unit_price);
        BillDetail::insert($insert); //khi dữ liệu gồm nhiều arr để insert thì ap dụng nó
        $producCart = array($nameProduct,$quantity,$unit_price);
        
        $result = [];
        foreach ($producCart as $key => $value) {
                // echo "<pre>";
                // print_r($value);
                // echo "</pre>";
                foreach ($value as $key1 => $value1) {
                        $result[$key1][] = $value1;
                }
        }
        // foreach ($result as $key3 => $value3) {
        //         echo "<pre>";
        //         print_r($value3);
        //         echo "</pre>";
                
        // }
        // die();
        //Send Mail
        $totalPrice = 0;
        foreach ($result as $key => $value) {
                $totalPrice += $value[2]*$value[1];
        }
        $data = [
            'email' => $req->email,
            'subject' => 'Shop_Duc',
            'user' => 'Don hang cua ban '.$req->name,
            'result'=> $result,
            'totalPrice' => $totalPrice,

        ];

        

        Mail::send('mail.mail', $data, function ($message) use ($data) {
            $message-> from('phamanhduc536@gmail.com','laravel2');
            $message-> to($data['email']);
            $message-> subject($data['subject']);

        });
        
        Cart::destroy();
        return redirect()->back()->with('thongbao','dat hang thanh cong- thong tin don hang da dc gui vao email cua ban');
    }

    //chuc nang dang nhap
    public function getLogin(){
        return view('pages.dangnhap');
    }
    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20',
            ],
            [
                'email.required' => 'email khong dc rong',
                'email.email'    => 'khong dung dinh dang email',
                'password.required' => 'password khong duoc rong',
                'password.min'  => 'do dai pass tu 6 den 12 ki tu',
                'password.max' => 'do dai pass tu 6 den 12 ki tu'
            ]
        );

        //lấy thông tin để so sánh với data
        $cridentials = array('email'=> $req->email,'password'=>$req->password);
        if (Auth::attempt($cridentials)) {
            return redirect()->back()->with(['flag'=>'success','message'=>'đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag'=>'danger','message'=>'đăng nhập thất bại']);
        }
    }
    

    //Chuc nang dang ki
    public function getSignin(){
        return view('pages.dangki');
    }
    public function postSignin(Request $req){
        $this->validate($req,
            [           //phải điền-phải dạng email- k được trùng với bảng user trường email
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required' => 'vui lòng nhập email',
                'email.email'  =>'sai định dạng email',
                'email.unique'  =>'email đã có người sử dụng',
                'password.required'=> 'nhập pass',
                'password.min'=> 'pass ít nhất 6 kí tự',
                'password.max'=> 'pass tối đa 20 kí tự',
                're_password.same'=> 'nhập lại pass không đúng'
            ]);

            $user = new User;
            $user -> full_name =$req->fullname;
            $user -> email =$req->email;
            $user -> password = Hash::make($req-> password);
            $user -> phone  = $req ->phone;
            $user -> address = $req ->adress;
            $user -> save();
            return redirect()->back()->with('thanhcong','Tạo tài khoản  thành công');
    }

    public function postDangXuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    //hàm xử lý chức năng tìm kiếm
    public function getSearch(Request $req){
        //viết câu truy vấn tìm kiếm dựa vào giá và tên sản phẩm
        $product = Product::where('name','like','%'.$req->key.'%') //tìm kiếm theo tên và phương thức like để % nữa
                            ->orWhere('unit_price',$req->key)
                            ->paginate(4);
        return view('pages.search',compact('product'));                    
    }

    public function test(){
        // $arrayA = ['keo','bimbim','kem'];
        // $arrayB = [2,5,6];
        // $arrayC = [2000,5000,7000];
        $arr = array(['keo','bimbim','kem'],[2,5,6],[2000,5000,7000]);
        $merd = [];
        foreach ($arr as $key => $value) {
                // echo "<pre>";
                // print_r($value);
                // echo "</pre>";
                
                foreach ($value as $key2 => $value2) {
                        // echo "<pre>";
                        // print_r($value2);
                        // echo "</pre>";
                    $merd[$key2][] = $value2;
                }
        }
        dd($merd);
       
        
        // $merd = [];
        // for ($i = 0; $i < 3 ; $i++) {
        //     $merd[$i][] = $arrayA[$i];
        //     $merd[$i][] = $arrayB[$i];
        //     $merd[$i][] = $arrayC[$i];
        // }
        //dd($merd);
    }  
    public function htmlMailTest(){
        $arr = array(['keo','bimbim','kem'],[2,5,6],[2000,5000,7000]);
        $merd = [];
        foreach ($arr as $key => $value) {
                // echo "<pre>";
                // print_r($value);
                // echo "</pre>";
                
                foreach ($value as $key2 => $value2) {
                        // echo "<pre>";
                        // print_r($value2);
                        // echo "</pre>";
                        
                    $merd[$key2][] = $value2;
                }
        }
        $totalPrice = 0;
        foreach ($merd as $key => $value) {
                $totalPrice += $value[2]*$value[1];
        }
         //dd($totalPrice);
        // die();
        return view('pages.test',compact('merd','totalPrice'));
    }     
}
