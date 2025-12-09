<?php

// namespace App\Http\Middleware;

// use Closure;

// class CustomAuth
// {
//     public function handle($request, Closure $next)
//     {
//         if (!session()->has('logged_in')) {
//             return redirect()->route('login.form');
//         }

//         return $next($request);
//     }
// }
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class CustomAuth
{
    // public function handle($request, Closure $next)
    // {
    //     if (!Session::has('logged_in')) {
    //         //old
    //         // return redirect('/login');
    //         return redirect('/')->with('error','กรูราเข้าสู่ระบบก่อนเเจ้งซ่อม');
    //     }
     

    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        // เช็คแค่ว่า Login หรือยัง
        if (!Session::has('logged_in')) {
            // แก้คำผิด: กรูรา -> กรุณา
            return redirect('/')->with('error', 'กรุณาเข้าสู่ระบบก่อนแจ้งซ่อม');
        }

        return $next($request);
    }
}


?>