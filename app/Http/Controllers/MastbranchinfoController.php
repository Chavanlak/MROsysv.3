<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Repository\MastbranchRepository;
use App\Models\Mastbranchinfo;
use Illuminate\Http\Request;

class MastbranchinfoController extends Controller
{
    // public static function getBranchInfo()
    // {
    //    $branches = MastbranchRepository::selectbranch();
    //    return view('repair', ['branches' => $branches]);
    // }
    public static function showallBranch()
    {
        $branches = MastbranchRepository::getallBranch();
        return view('testmail', ['branches' => $branches]);
    }
    // public static function pullBranch(){
    //     return view('repair');
    // }
    public static function getselectBranch()
    {
        $branch = MastbranchRepository::selectbranch();
        return view('branch', compact('branch'));
    }
    // public static function saveBranch(Request $request){
    //     $branch = new Mastbranchinfo();
    //     // $branch->MBranchInfo_Code = $request->input('MBranchInfo_Code');
    //     $branch = $request->MBranchInfo_Code;
    //     $branch = $request->Location;
    //     $branch->save();


    //     return redirect()->back()->with('success', 'Branch saved successfully!');
    // }
    // public function saveBranch(Request $request)
    // {
    //     $request->validate([
    //         'MBranchInfo_Code' => 'required|string',
    //         'Location' => 'required|string',
    //     ]);

    //     $branch = new Mastbranchinfo();
    //     $branch->MBranchInfo_Code = $request->input('MBranchInfo_Code');
    //     $branch->Location = $request->input('Location');
    //     $branch->branch_active = 1; 
    //     $branch->save();
    
    //     return redirect()->back()->with('success', 'Branch saved successfully!');
    // }

    public function saveBranch(Request $request)
{
    // ตรวจสอบค่าที่รับมาจาก dropdown ชื่อ "branch"
    dd($request->branch); 

    $request->validate([
        'branch' => 'required|string',
    ]);

    $branch = Mastbranchinfo::where('MBranchInfo_Code', $request->branch)->first();

    if (!$branch) {
        return redirect()->back()->with('error', 'ไม่พบสาขาที่เลือก');
    }

    Session::put('MBranchInfo_Code', $branch->MBranchInfo_Code);
    Session::put('Location', $branch->Location);

    return redirect()->back()->with('success', 'ยืนยันสาขาแล้ว: ' . $branch->Location);
}
// public static function showRepair2Form()
// {
//     // ดึง email ทั้งหมดจาก database
//     $branchmail = MastbranchRepository::getallBranchEmail();

//     // ส่งไปที่ view repair2
//     return view('repair2', compact('branchmail'));
// }

    public static function getemail(Request $req){
        $branchmail = MastbranchRepository::getallBranchEmail();
        return view('repair2',compact('branchmail'));
        // dd($branchmail);
        // return redirect("/repair2")->with('branchmail', $branchmail);
    }


    //     public function storeBranch(Request $request)
    // {
    // $validated = $request->validate([
    //  'branch' => 'required|string'
    // ]);

    //     // เก็บไว้ใน session หรือฐานข้อมูล แล้วแต่ต้องการ
    //  Session::put('selected_branch', $validated['branch']);

    // return redirect()->back()->with('success', 'บันทึกสาขาเรียบร้อยแล้ว');
    // }


}
