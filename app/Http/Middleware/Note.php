<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class Note
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    
        if (!Session::has('logged_in')) {
            return redirect('/login');
        }
    
        // ถ้า role = AdminTechnicianStore
        if (Session::get('role') === 'AdminTechnicianStore') {
            return redirect('/loginstore');
        }
}
}
    //ผิดทั้งคู่
        // if(Session::get('role' === 'AdminTechnicianStore')){
        //     return redirect('/loginstore');
        //   }
        // if(Session::get(('role') === 'AdminTechnicianStore')){
        //     return redirect('/loginstore');
        //   }