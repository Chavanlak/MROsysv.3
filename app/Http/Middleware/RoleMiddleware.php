<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
     //old
    // public function handle(Request $request, Closure $next)
    public  function handle(Request $request,Closure $next,$role)
    {
        // 1. Check if the user is logged in at all. If not, redirect to login page.
        if (!Session::has('logged_in')) {
            //old
            // return redirect('/loginstore');
            return redirect('/')->with('error','กรุณาเข้าสู่ระบบ');
        }

      
        $userRole = Session::get('role');

        if($userRole !== $role){
            // return redirect('/')->with('error','คุณไม่มีสิทธิ์เข้าใช้งานในหน้านี้');
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าใช้งานในหน้านี้ (' . $role . ' only)');
        }
       
       
        return $next($request);
    }
     //old
        // return redirect('/loginerorstore');
      //old
        // $role = Session::get('role');
        
        // old
        // if ($role === 'AdminTechnicianStore') {
        //     return $next($request);
        // }
        // if($role === 'Frontstaff'){
        //     return $next($request);
        // }

}