<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\RedirectResponse;
class UserController extends Controller
{
    public function getDanhSach(){
    	$user = User::all();
        //return dd($user);
    	return view('admin.user.danhsach',['user'=>$user ]);
    }

    //tìm và đổ dữ liệu sang bên form
    public function getSua($id){
        $user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);	
    }

    //nhận dữ liệu từ form về  kèm theo cái id nữa
    public function postSua(Request $request ,$id){
    	$this->validate($request,
            [
                'hoten' => 'required|min:3|max:20',
                'phone' => 'required',
                'address'=>'required'
            ],
            [
                'hoten.required' => 'Bạn chưa nhập tên',
                'hoten.min' => 'độ dài không hợp lệ',
                'hoten.max' => 'độ dài không hợp lệ',
                'phone.required' => 'phone k duoc rong',
                'address.required' => 'address k duoc rong',
            ]
        );
        $user = User::find($id);
        $user->full_name = $request->hoten;
        $user->phone = $request->phone;
        
        $user->address = $request->address;
        if($request->changePassword == "on"){ //nếu người dùng check thì cái ô kia có giá trị là on
            $this->validate($request,
            [
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password', //phải giống pass ở trên
            ],
            [
                'password.required'=> 'password không được rỗng',
                'password.min' => 'độ dài password k hợp lệ',
                'password.max' => 'độ dài k hợp lệ',
                'passwordAgain.required' => 'passwordAgain không được rỗng',
                'passwordAgain.same' => 'pass nhập lại k chính xác',
            ]);
            $user->password =  bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with(['thongbao'=>'sua Thành công']);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'hoten' => 'required|min:3|max:20',
    			'email'	=> 'required|email|unique:users,email', //ko được trùng với bản users cột email
    			'password' => 'required|min:3|max:32',
    			'passwordAgain' => 'required|same:password', //phải giống pass ở trên
    			'phone'	=> 'required',
    			'address'=>'required'
    		],
    		[
    			'hoten.required' => 'Bạn chưa nhập tên',
    			'hoten.min' => 'độ dài không hợp lệ',
    			'hoten.max' => 'độ dài không hợp lệ',
    			'email.required' => 'Bạn chưa nhập email',
    			'email.email' => 'Bạn chưa nhập đúng định dạng email',
    			'email.unique' => 'Email đã tồn tại',
    			'password.required'=> 'password không được rỗng',
    			'password.min' => 'độ dài password k hợp lệ',
    			'password.max' => 'độ dài k hợp lệ',
    			'passwordAgain.required' => 'passwordAgain không được rỗng',
    			'passwordAgain.same' => 'pass nhập lại k chính xác',
    			'phone.required' => 'phone k duoc rong',
    			'address.required' => 'address k duoc rong',
    		]
    	);
        //return dd($request);
    	//tạo ra người dùng để lưu
    	$user = new User();
    	$user->full_name = $request->hoten;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->password =  bcrypt($request->password);
    	$user->address = $request->address;
    	$user->save();
    	return redirect('admin/user/them')->with(['thongbao'=>'Them Thành công']);
    }
    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xoa nguoi dung thanh cong');
    }
}
