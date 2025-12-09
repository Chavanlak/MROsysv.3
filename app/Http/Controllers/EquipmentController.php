<?php

namespace App\Http\Controllers;

use App\Repository\EquipmentRepository;
use App\Repository\EquipmentTypeRepository;
use App\Repository\MastbranchRepository;
use App\Repository\NotirepairRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class EquipmentController extends Controller
{
// public static function ShowAllEquipment()
// {
//     $equipment = EquipmentRepository::getallEquipment();
//     return view('/repair2',compact('equipment'));
// }

// แสดงรายการอุปกรณ์ทั้งหมดในหน้า repair2
// public static function ShowAllEquipment(Request $req)
// {
//     // dd($req->category); //oject category
//     // ตรวจสอบว่ามีการส่งค่า category มาหรือไม่
//     $equipment = EquipmentRepository::getequipmentById($req->category);
//     $branchmail = MastbranchRepository::getallBranchEmail();
//     // $zoneEmail = NotirepairRepository::getSelectZoneEmail();
//     $emailRepair = EquipmentTypeRepository::getEmailRepair($req->category);
//     // $emailRepair = EquipmentTypeRepository::getEmailRepairById($req->mailrepair);

//     $branchname = $req->branch;
//     $emailZone = NotirepairRepository::getSelectZoneEmail();
//     // $zone = $emailZone->where('email', $req->zone)->first();
//     $zone = $emailZone->email;

//     // $zonename = $req->zone;
//     // $zoneEmail = NotirepairRepository::getemailZone($zonename);
//     // $zoneData = $req->zone;

//     // $emailZone = null;
//     // if ($zoneData) {
//     //     // 3. Decode the JSON string to get a PHP object.
//     //     $zoneObject = json_decode($zoneData);

//     //     // 4. Check if the object and its email property exist.
//     //     if ($zoneObject && isset($zoneObject->email)) {
//     //         $emailZone = $zoneObject->email;
//     //     }
//     // }
//     //ส่งค่าพารามิเตอร์ไปยัง view
//     // dd($req->all());
//     // dd($zone);
//     // return view('/repair2',compact('equipment','branchmail','zoneEmail','branchname','zonename','emailRepair'));
//     return view('/repair2',compact('equipment','branchmail','branchname','emailRepair','zone'));

// }
public static function ShowAllEquipment(Request $req)
{
    $submissionToken = Str::uuid()->toString();
    Session::put('submission_token', $submissionToken);
    // dd($req->category); //oject category
    // ตรวจสอบว่ามีการส่งค่า category มาหรือไม่
    $equipment = EquipmentRepository::getequipmentById($req->category);

    //เดิม
    $branchmail = MastbranchRepository::getallBranchEmail();
    $branch = $branchmail->email;
    //เพิ่ม

    $branchid = $req->branch; 
    $branchname = MastbranchRepository::getBranchName($branchid); 

    $emailRepair = EquipmentTypeRepository::getEmailRepair($req->category);




    $emailZone = NotirepairRepository::getSelectZoneEmail();
    $zone = $emailZone->email;
    $zoneInfo = NotirepairRepository::getZoneInfoByEmail($zone);

    $staffname = $zoneInfo->StaffName;



//step2
    $branchEmail = MastbranchRepository::findEmailByname($req->branch); // ดึงอีเมลของสาขาจากชื่อสาขา
    $zoneEmail = NotirepairRepository::findZoneEmailByName($req->zone); // ดึงอีเมลของโซนจากชื่อโซน
    $zonename = $req->zone; // ชื่อโซนที่ส่งมาจากฟอร์ม

    Session::put('branchcode', $req->branch); //เอารหัส branch มาใช้เก็บใน session
    Session::put('zonning', $req->zone);
    Session::put('category', $req->category);
    return view('/repair2',compact('equipment','branch','emailRepair','zone','staffname','branchname','branchEmail','zoneEmail','zonename','branchid','submissionToken'));


}
public static function backtorepair(){
    return redirect('/repair')->with('branchcode', Session::get('branchcode'))->with('zonning', Session::get('zonning'))->with('category', Session::get('category'));

}
}
?>
