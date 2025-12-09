<?php

namespace App\Http\Controllers;

use App\Models\Equipmenttype;
use App\Repository\EmailRepairRepository;
use App\Repository\EquipmentRepository;
use App\Repository\EquipmentTypeRepository;
use Illuminate\Http\Request;

class EquipmenttypeController extends Controller
{
    // public  static function getEmailRepair(){
    //     $emailrepair = EmailRepairRepository::getAllEmailRepairs();
    //     return view('/emailrepair', compact('emailrepair'));
    // }
// public static function showEmailRepair(){
//    $emailRepair = EquipmentTypeRepository::getEmailRepair();
//    return view('repair2',compact('emailRepair'));
// }
public function showEmailRepair(Request $request)
{
    $emailRepair = EquipmentTypeRepository::getEmailRepair($request->category);

    return view('repair2', compact('emailRepair'));
}
// public function showEmailRepair(Request $request)
// {
//     $category = $request->category;

//     // ตรวจสอบว่ามีค่า category มั้ย ถ้าไม่มี กำหนดค่า default หรือ return
//     if (!$category) {
//         return redirect()->back()->with('error', 'กรุณาเลือกประเภทอุปกรณ์');
//     }

//     $emailRepair = EquipmentTypeRepository::getEmailRepair($category);

//     // ถ้าไม่พบข้อมูล ก็สามารถส่ง array ว่างกลับไป
//     if (!$emailRepair) {
//         $emailRepair = collect(); // ใช้ Collection ว่าง
//     }

//     return view('repair2', compact('emailRepair'));
// }
//dashbordAdminIT
public static function AddEquipmenttype(){
    
}

}
