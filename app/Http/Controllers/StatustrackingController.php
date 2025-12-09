<?php

namespace App\Http\Controllers;

use App\Models\NotiRepair;
use App\Models\Statustracking;
use App\Repository\AsStringable;
use App\Repository\NotiRepairRepository;
use App\Repository\StatustrackingRepository;
use Illuminate\Http\Request;
use App\Repository\TrackingStatusEnum;

class StatustrackingController extends Controller
{
    //รindex get all หน้า status Route::get('/status',[StatustrackingController::class,'index']);
    public static function index()
    {
        $statusList = StatustrackingRepository::getAllStatustracking();
        return view('dashborad.admintecnicialtest', compact('statusList'));
    }
    //กดรับเพื่ออัพเดตสถานะการรับของ Route::post('/status/change/item/{statustrackingId}', [StatustrackingController::class, 'changeStatusItem'])->name('status.change');
    public static function changeStatusItem($statustrackingId)
    {
        StatustrackingRepository::updateStatus($statustrackingId, TrackingStatusEnum::RECEIVED);

        $status = StatustrackingRepository::getStatustrackingById($statustrackingId);
        $notiRepairId = $status->NotirepairId;

        return redirect()->route('status.repair.detail', $notiRepairId)
            ->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    }
  //redirect ไปที่หน้ารายการเเจ้งซ่อมเพื่อดูของที่จะซ่อม 
    public static function showNotiRepair($statustrackingId)
    {
        // ดึงข้อมูลแจ้งซ่อม
        $notiRepair = NotiRepairRepository::getNotirepirById($statustrackingId);

        return view('dashborad.notirepairlist', compact('notiRepair'));
    }
    
    public static function changeStatusSupplier($statustrackingId)
    {
        StatustrackingRepository::updateStatus($statustrackingId, TrackingStatusEnum::SENTTOSUPPLIER);
        return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    }
    public static function changeStatusRepair($statustrackingId)
    {
        StatustrackingRepository::updateStatus($statustrackingId, TrackingStatusEnum::REPAIRFINISHED);
        return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    }

      
    // public static function showNotiRepair($statustrackingId)
    // {
    //     // หาข้อมูลสถานะก่อน
    //     $status = StatustrackingRepository::getStatustrackingById($statustrackingId);

    //     if (!$status) {
    //         return abort(404, 'Status not found');
    //     }

    //     // ดึง NotirepairId จาก status
    //     $notiRepairId = $status->NotirepairId;

    //     // ไปดึงข้อมูลแจ้งซ่อม
    //     $notiRepair = NotiRepairRepository::getNotirepirById($notiRepairId);

    //     return view('dashborad.notirepairlist', compact('notiRepair'));
    // }
    // public static function showNotiRepair($statustrackingId)
    // {
    //     // ดึงแถวเดียวจาก Statustracking
    //     $status = StatustrackingRepository::getStatustrackingById($statustrackingId);

    //     if (!$status) {
    //         abort(404, 'Status tracking not found');
    //     }

    //     // ใช้ชื่อ field ให้ตรงกับ database
    //     $notiRepairId = $status->NotirepairId;

    //     // ดึงข้อมูลแจ้งซ่อม
    //     $notiRepair = NotiRepairRepository::getNotirepirById($notiRepairId);

    //     if (!$notiRepair) {
    //         abort(404, 'Repair request not found');
    //     }

    //     return view('dashborad.notirepairlist', compact('notiRepair'));
    // }

  
    // public static function changeStatusItem($statustrackingId)
    // {
    //     StatustrackingRepository::updateStatus(
    //         $statustrackingId,
    //         TrackingStatusEnum::RECEIVED
    //     );

    //     $status = StatustrackingRepository::getStatustrackingById($statustrackingId);

    //     if (!$status) {
    //         return redirect()->back()->with('error', 'ไม่พบข้อมูลสถานะ');
    //     }

    //     $notiRepairId = $status->NotirepairId;

    //     return redirect()->route('status.repair.detail', $notiRepairId)
    //         ->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    // }


    // public static function changeStatusItem($statustrackingId){
    //     // NotiRepairRepository::getNotirepirById();
    //     StatustrackingRepository::updateStatus($statustrackingId, TrackingStatusEnum::RECEIVED);
    //     // $notiRepair = NotiRepairRepository::getNotirepirById($statustrackingId);
    //     return redirect()->route('status.repair.detail', $statustrackingId)
    //     ->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');

    //     // return view('dashborad.notirepairlist', compact('notiRepair'))
    //     // ->with('success', 'อัพเดตสถานะเรียบร้อยแล้ว');
    //     // return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    // }




    // public static function changeStatusItem($statustrackingId){
    //     StatustrackingRepository::updateStatus($statustrackingId, AsStringable::RECEIVED);
    //     return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    // }
    // public static function changeStatusSupplier($statustrackingId){
    //     StatustrackingRepository::updateStatus($statustrackingId, AsStringable::SENTTOSUPPLIER);
    //     return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    // }
    // public static function changeStatusRepair($statustrackingId){
    //     StatustrackingRepository::updateStatus($statustrackingId, AsStringable::REPAIRFINISHED);
    //     return redirect()->back()->with('success', 'อัพเดทสถานะเรียบร้อยแล้ว');
    // }
    public static function getStatus()
    {
        // $status = StatustrackingRepository::getNotReceivedItems();
        // $status  = StatustrackingRepository::getNotSentToSupplierItems();
        // dd($status);
        // return $status;
        // $status = StatustrackingRepository::checkstatus();
        return view('dashborad.admintecnicialtest', compact('status'));
    }

    public static function showall()
    {
        $allstatus = StatustrackingRepository::getAllStatustracking();
        // if($allstatus->isEmpty()){
        //     dd($allstatus->first()->status);
        // }
        // dd($allstatus);
        // return $allstatus;

    }
    public static function getItemRecivecomplete(){
       $complete = StatustrackingRepository::getItemComplte();
        return redirect('/itemcomplte');
    } 
}
