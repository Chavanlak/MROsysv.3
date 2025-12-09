<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testuser extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('password', $request->password) // ไม่ใช้ hash
            ->first();

        if ($user) {
            session(['logged_in' => true, 'user' => $user]);
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['Invalid credentials']);
        }
    }
}
?>
