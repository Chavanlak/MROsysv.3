<?php

// namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use App\Repository\UserRepository;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//    public static function login(){
//     return view('login');
//    }

//    public static function loginPost(){
//     $credentials = [
//         'staffname'=>request('staffname'),
//         'staffpassword'=>request('staffpassword')
//     ];
//     if(Auth::attempt($credentials)){
//         return redirect('/repair')->with('success','Login Successful');

//    }
//     else{
//         return redirect('/loginerror')->with('error','Login Failed');
//     }
//    }
//    public static function logineror(){
//     return "error";
//    }
//    public static function checklogin(){
//     return "Hello i can see this";
//    }
//    public static function page(){
//     return view('repair');
//    }
// }
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    //new 

//     public function loginPost(Request $request) {
//         $staffcode = $request->input('staffcode');
//         $staffpassword = $request->input('staffpassword');
        
//         // 1. ดึงข้อมูล User
//         $user = DB::table('staff_rc')->where('staffcode', $staffcode)->first();
    
//         if (!$user) {
//             return redirect('/')->with('error', 'ไม่พบผู้ใช้นี้');
//         }
//         if ($user->staffpassword !== $staffpassword) {
//             return redirect('/')->with('error', 'รหัสผ่านไม่ถูกต้อง');
//         }
    
//         // 2. เก็บ Session (แก้คำว่า looged เป็น logged ให้ด้วยครับ)
//     Session::put('logged_in', true);
//     Session::put('staffname', $user->staffname);
//     Session::put('staffcode', $user->staffcode);
//     Session::put('permis_BM', $user->permis_BM);
//     Session::put('role', $user->role);
//     if ($user->role === 'AdminTechnicianStore') {
//         return redirect('/noti'); 
//     }
    

   
//         if ($user->permis_BM == 'N' || $user->permis_BM == 'n') {
//             // Frontstaff ที่ไม่ใช่ BM จะมาหน้านี้
//             return redirect('/repair'); 
//         } 
//         else {
//             // Frontstaff ที่เป็น BM จะมาหน้านี้ (ถูกต้องตามต้องการ)
//             return redirect('/repairBM'); 
//         }
//     // }
// }
public function loginPost(Request $request){

    $staffcode = $request->input('staffcode');
    $staffpassword = $request->input('staffpassword');

    $user = DB::table('staff_rc')->where('staffcode',$staffcode)->first();

    //ดึงข้อมูลผู้ใช้
    if(!$user){
        return redirect('/')->with('error','ไม่พบผู้ใช้');
    }
    if($user->staffpassword != $staffpassword){
        return redirect('/')->with('error', 'รหัสผ่านไม่ถูกต้อง'); 
    //เก็บ seesion
    Session::put('logged_in',true);
    Session::put('staffname',$user->staffname);
    Session::put('staffcode',$user->staffcode);
    Session::put('permis_BM',$user->permis_BM);
    Session::put('role',$user->role);

    // if(($user->role === 'FrontStaff') &&  ($user->permis_BM === 'Y')){
    //     return redirect('/noti/storefront');
    // }
    // elseif (($user->role != 'FrontStaff') &&  ($user->permis_BM === 'Y')){
    //     return redirect('/repair')->with('success', 'เข้าสู่ระบบสำเร็จ');

    //     return redirect('/repair');
    // }
    // if($user->role === 'AdminTechnicianStore'){
    //     return redirect('noti');
    // }


    if ($user->role === 'AdminTechnicianStore') {
        return redirect()->route('noti.list'); // หรือ redirect('noti')
    }

    // CASE B: FrontStaff ที่เป็น BM (คนรับของหน้าร้าน)
    if ($user->role === 'Frontstaff' && $user->permis_BM === 'Y') {
        return redirect()->route('noti.storefront'); // หรือ redirect('/noti/storefront')
    }

    // CASE C: User ทั่วไป (N) และ User BM แผนกอื่น (Y ที่ไม่ใช่ FrontStaff)
    // ให้ส่งไป /repair ทั้งหมด 
    // เพราะใน Controller: ShowRepairForm เราเขียน Logic แยก View ไว้แล้ว
    return redirect('/repair')->with('success', 'เข้าสู่ระบบสำเร็จ');
}
 // 3.1 กลุ่มช่าง / Admin -> ไปหน้า Dashboard ช่าง
//  if ($user->role === 'AdminTechnicianStore') {
//     return redirect('/noti'); 
// } 

// // 3.2 กลุ่ม Frontstaff
// $permis = strtoupper($user->permis_BM); 

// // เช็คว่าเป็น BM หรือไม่?
// if ($permis !== 'N') {
//     // [CASE BM] เป็น BM -> พุ่งไปหน้าฟอร์มแจ้งซ่อมทันที
//     return redirect('/repairBM');
// } 
// else {
//     // [CASE Frontstaff ทั่วไป] -> พุ่งไปหน้า Dashboard หน้าร้าน
//     // ** แก้ตรงนี้จาก /repair เป็น route ของ Dashboard ครับ **
//     // return redirect()->route('noti.storefront'); 
//     return redirect()->route('/repair'); 

//     // หรือ return redirect('/noti/storefront'); 
// }
    }
    // class UserController extends Controller
    // {
    //     // 1. หน้าดูข้อมูลส่วนตัว (Profile)
    //     public function profile()
    //     {
    //         // ดึงรหัสพนักงานจาก Session
    //         $staffcode = Session::get('staffcode');
    
    //         if (!$staffcode) {
    //             return redirect('/')->with('error', 'กรุณาเข้าสู่ระบบ');
    //         }
    
    //         // ดึงข้อมูลจากตาราง staff_rc (Database MMS)
    //         $user = DB::table('staff_rc')->where('staffcode', $staffcode)->first();
            
    //         // ถ้าเป็น BM อาจจะอยากดึงชื่อสาขามาโชว์ด้วย
    //         $branchName = null;
    //         if (strtoupper($user->permis_BM) !== 'N') {
    //              // ใช้ Logic เดิมของคุณดึงชื่อสาขา
    //              // $branchName = ...
    //         }
    
    //         return view('user.profile', compact('user', 'branchName'));
    //     }
    
    //     // 2. ฟังก์ชันเปลี่ยนรหัสผ่าน (Change Password)
    //     public function updatePassword(Request $request)
    //     {
    //         $request->validate([
    //             'old_password' => 'required',
    //             'new_password' => 'required|min:4',
    //             'confirm_password' => 'required|same:new_password'
    //         ]);
    
    //         $staffcode = Session::get('staffcode');
            
    //         // ดึงข้อมูล User มาเช็ค
    //         $user = DB::table('staff_rc')->where('staffcode', $staffcode)->first();
    
    //         // 1. เช็คว่ารหัสเก่าถูกไหม
    //         if ($user->staffpassword !== $request->old_password) {
    //             return back()->with('error', 'รหัสผ่านเดิมไม่ถูกต้อง');
    //         }
    
    //         // 2. อัพเดทรหัสใหม่
    //         DB::table('staff_rc')
    //             ->where('staffcode', $staffcode)
    //             ->update(['staffpassword' => $request->new_password]);
    
    //         return back()->with('success', 'เปลี่ยนรหัสผ่านสำเร็จ');
    //     }
    // }

// public function loginPost(Request $request) 
// {
//     $staffcode = $request->input('staffcode');
//     $staffpassword = $request->input('staffpassword'); 

//     // 1. ดึงข้อมูล User
//     $user = DB::table('staff_rc')->where('staffcode', $staffcode)->first();

//     if (!$user) {
//         return redirect('/')->with('error', 'ไม่พบผู้ใช้นี้ในระบบ');
//     }

//     if ($user->staffpassword !== $staffpassword) {
//         return redirect('/')->with('error', 'รหัสผ่านไม่ถูกต้อง');
//     }

//     // 2. เก็บ Session
//     Session::put('logged_in', true);
//     Session::put('staffname', $user->staffname);
//     Session::put('staffcode', $user->staffcode);
//     Session::put('permis_BM', $user->permis_BM);
//     Session::put('role', $user->role);

//     // ---------------------------------------------------------
//     // 3. Logic การ Redirect (แก้ไขใหม่)
//     // ---------------------------------------------------------

//     // 3.1 กลุ่มช่าง / Admin (คนรับงาน)
//     if ($user->role === 'AdminTechnicianStore') {
//         return redirect('/noti'); 
//     } 
//     // *** ต้องมีวงเล็บปิดตรงนี้เสมอ ***

//     // 3.2 กลุ่ม Frontstaff (คนแจ้งงาน)
//     $permis = strtoupper($user->permis_BM); 

//     // เช็คว่าเป็น BM หรือไม่? (ถ้าไม่ใช่ N แปลว่าเป็น BM)
//     if ($permis !== 'N') {
//         // [CASE 1] เป็น BM -> ไปหน้าฟอร์ม BM
//         return redirect('/repairBM');
//     } 
//     else {
//         // [CASE 2] เป็น Frontstaff ทั่วไป (permis == 'N')
//         // เลือกเอา 1 อย่างตามที่คุณต้องการครับ:
        
//         return redirect('/repair');          // แบบ 1: ไปหน้าแจ้งซ่อมเลย (แบบเดิม)
//         // return redirect('/dashboard');       // แบบ 2: ไปหน้า Dashboard (ที่เราคุยกัน)
//         // return redirect('/noti/storefront'); // แบบ 3: ไปหน้า storefront (ที่คุณเขียนไว้ใน else)
//     }
// }
    // ❌ ลบส่วนนี้ออกครับ! 
    // เพื่อไม่ให้ Frontstaff ถูกดีดไป Dashboard 
    // elseif ($user->role === 'Frontstaff') {
    //     return redirect('/noti/storefront'); 
    // }

    // 2. คนทั่วไป + Frontstaff + Officer -> มาทางนี้หมด
    // ระบบจะเช็คเองว่าเป็น BM หรือไม่ แล้วพาไปหน้าแจ้งซ่อมที่ถูกต้อง
    // else {
//     public function loginPost(Request $request)
//     {
//         // $staffname = $request->input('staffname');
//         $staffcode = $request->input('staffcode');
//         $staffpassword = $request->input('staffpassword');
//         $user = DB::table('staff_rc')->where('staffcode', $staffcode)->first();
       
//     if(!$user){
//         return redirect('/')->with('error', 'ไม่พบชื่อผู้ใช้นี้');
//     }
//     if($user->staffpassword !== $staffpassword){
//         return redirect('/')->with('error', 'รหัสผ่านไม่ถูกต้อง');
//     }

//     Session::put('logged_in', true);
//     Session::put('staffname', $user->staffname);
//     Session::put('staffcode', $user->staffcode);
//     //add
//     Session::put('permis_BM',$user->permis_BM);

//     // return view('/branch');
//     // return redirect('/branch')->with('success', 'เข้าสู่ระบบสำเร็จ');
//     return redirect('/repair')->with('success', 'เข้าสู่ระบบสำเร็จ');
// }
    public function loginerror()
    {
        return view('loginerror');
    }

    public function logout()
    {
        Session::flush();
        // return redirect('/login');
        return redirect('/');
    }

    public function showrepair()
    {
        return view('repair');
    }

    //dashbord
    //auth store
    public static function loginDashbord(){
        return view('authen.loginTechnicialStore');
    }
    public static function loginPostDashbord(Request $request){
        $staffcode = $request->input('staffcode');
        $staffpassword = $request->input('staffpassword');
        $user = DB::table('staff_rc')->where('staffcode',$staffcode)->first();
        $role = DB::table('staff_rc')->where('role',)->first();
        if($role === 'Frontstaff'){
            return redirect('/loginFrontstaff');
        }
        if($role == 'AdminTechnicianStore'){
            return redirect('loginTechnicialStore');
        }
        if(!$user){
            return redirect('/loginTechnicialStore')->with('error','ไม่พบผู้ใช้นี้');
        }
        if($user->staffpassword != $staffpassword){
            return redirect('/loginTechnicialStore')->with('error','รหัสผ่านไม่ถูกต้อง');
        }
        Session::put('logged_in', true);  
        Session::put('staffname',$user->staffname);
        Session::put('staffcode',$user->staffcode);
        Session::put('role',$user->role);
        // dd($user);
        // return redirect('/notirepairlist');
        return redirect('/noti'); 
    }
    public static function loginerrorstore(){
        return view('loginerror');
    }
    public static function logoutstore(){
        Session::flush();
        return redirect('/loginstore');
    }
    //auth front
    

}

?>


