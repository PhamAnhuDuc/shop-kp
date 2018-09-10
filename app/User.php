<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //phần gửi mail active
    protected $fillable = [
        'name', 'email', 'password','activated','activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];
    protected $casts = [
        'activated' => 'boolean' // mục đích dữ liệu = 1 trả về true  = 0 trả về false trong bảng dữ liệu
    ];
    public static function boot(){
        parent::boot(); //kế thừa từ tk boot
        //lúc nó đang tạo thì gán token này vô đó
        static::creating(function ($user){
            $user->activation_token = static::generateUniqueActivationToken();
        });
    }

    //phương thức để tạo ra các chuỗi k bị trùng

    public static function generateUniqueActivationToken(){
        do {
            $token = str_random(32);
        }while($user = static::where('activation_token',$token)->first()); //tìm user với token vừa tạo trong CSDL nếu có là true đến thi k có nghĩa là nó là chuỗi duy nhất
        return $token;
    }

    protected $table = "users";
}
