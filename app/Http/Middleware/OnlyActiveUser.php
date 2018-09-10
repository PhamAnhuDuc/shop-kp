<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class OnlyActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->activated){
            return $next($request);
        }
        Auth::logout(); //thoát nó ra và chuyển về trang đăng nhập
        return redirect()->route('login')
                        ->withErrors([
                               'email' => ['Only Active User '], 
                        ]);
        //bước tiếp theo vào kernel khai báo tiếp
    }
}
