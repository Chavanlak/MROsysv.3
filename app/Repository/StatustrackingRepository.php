<?php

namespace App\Repository;
use App\Models\Statustracking;

use App\Models\NotiRepair;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\Enums\TrackingStatus;
// enum AsStringable: string
enum TrackingStatusEnum: string
{
    // ค่าต้องตรงกับในฐานข้อมูล'('ยังไม่ได้รับของ','ได้รับของเเล้ว','ยังไม่ส่งSuplier','ส่งSuplierเเล้ว','ยังไม่ดำเนินการซ่อม','ซ่อมงานเสร็จเเล้ว'
    case NOTRECEIVED = 'ยังไม่ได้รับของ';
    case RECEIVED = 'ได้รับของเเล้ว';
    case NOTSENTTOSUPPLIER = 'ยังไม่ส่งSuplier';
    case SENTTOSUPPLIER = 'ส่งSuplierเเล้ว';
    case REPAIRNOTSTARTED = 'ยังไม่ดำเนินการซ่อม';
    case REPAIRFINISHED = 'ซ่อมงานเสร็จเเล้ว';
    // case WORKNOTFINISHED = 'ยังไม่เสร็จงาน';
}
class StatustrackingRepository
{
    // public static function getLatestStatusByNotiRepairId($notiRepairId)
    // {
    //     return Statustracking::where('NotirepairId', $notiRepairId)
    //         ->orderBy('statustrackingId', 'desc') 
    //         ->first()->status;
    //          //จะเอา เเค่ status ไปใส่ใน DTO
    //     // ดึงแค่รายการแรก (สถานะล่าสุด)
    // }
    public static function getLatestStatusByNotiRepairId($notiRepairId)
    {
        // ค้นหาสถานะล่าสุดตาม NotirepairId และเรียงจากมากไปน้อย
        $latestStatusRecord = Statustracking::where('NotirepairId', $notiRepairId)
            ->orderBy('statustrackingId', 'desc')
            ->first();

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($latestStatusRecord) {
            // คืนค่าเฉพาะ 'status'
            return $latestStatusRecord->status;
        }

        // คืนค่าสถานะเริ่มต้น (Default Status) หากไม่พบข้อมูล
        return 'ยังไม่ได้รับของ';
    }

    public static function getStatustrackingById($statustrackingId) // เพิ่ม parameter
    {
        // ใช้ where() เพื่อกรองตาม ID แล้วใช้ first() เพื่อให้ได้ Model Object เดียว
        return Statustracking::where('statustrackingId', $statustrackingId)->first();
    }

    public static function getNotirepirById()
    {
        //ดึงมาทั้งหมด
        return Statustracking::where('NotirepairId')->get();
    }
    //use this
    public static function updateStatus($statustrackingId, $status)
    {
        DB::table('statustracking')
            ->where('statustrackingId', $statustrackingId)
            ->update(['status' => $status->value]); // enum -> string
    }
    public static function getAllStatustracking()
    {
        return Statustracking::all();
    }
    //one many relation เพื่อดึงสถานะล่าสุดของ notirepair
    public static function updateNotiStatus($notirepaitid, $status, $statusDate)
    {
        $statustracking = new Statustracking();
        $statustracking->NotirepairId = $notirepaitid;
        $statustracking->status = $status;
        // $statustracking->statusDate = $statusDate;
        $statustracking->StatusDate = Carbon::now();
        // $statustracking->statustrackingId;
        $statustracking->save();
       

        return $statustracking;
    }

    public static function acceptNotirepair($notirepaitid)
    {
        $statustracking = new Statustracking();
        $statustracking->NotirepairId = $notirepaitid;
        $statustracking->status = 'ได้รับของเเล้ว';
        // $statustracking->statustrackingId;
        $statustracking->save();
       

        return $statustracking;
    }
    //     public static function acceptNotirepair($notirepaitid)
    // {
    //     return Statustracking::where('NotirepairId', $notirepaitid)
    //         ->update(['status' => 'ได้รับของแล้ว']);
    // }

    public static function updateStatusNotirepair($notirepaitid, $statusData)
    {
        $statustracking = new Statustracking();
        $statustracking->NotirepairId = $notirepaitid;
        $statustracking->status = $statusData;
        $statustracking->save();
        return $statustracking;
    }
    // public static function getNotiDetails($notirepaitid)
    // {
    //     // ดึงข้อมูลการแจ้งซ่อม พร้อมโหลดความสัมพันธ์ของสถานะ (ถ้ามี)
    //     $notiDetail = Notirepair::where('NotirepairId', $notirepaitid)
    //         // สมมติว่าใน Notirepair Model มีความสัมพันธ์ชื่อ 'statusTracking'
    //         // ถ้าไม่มีความสัมพันธ์ ให้ใช้ join() แทน
    //         ->with('statusTracking')
    //         ->first();

    //     return $notiDetail;
    // }
    //ดึงสถานะล่าสุดมา ไว้ใน object notiDetail
    public static function getNotiDetails($notirepaitid)
    {
        // ดึงข้อมูลการแจ้งซ่อม พร้อมโหลดความสัมพันธ์ของสถานะ (ถ้ามี)
        $notiDetail = Notirepair::select('notirepair.*', 'equipment.equipmentName') // **เลือก equipmentName**

            // เชื่อม Notirepair.equipmentId กับ Equipment.equipmentId
            ->leftJoin('equipment', 'equipment.equipmentId', '=', 'notirepair.equipmentId')

            ->where('NotirepairId', $notirepaitid)
            // ถ้ามีความสัมพันธ์ statusTracking อยู่แล้ว ก็เก็บไว้
            ->with('statusTracking')
            ->first();

        if ($notiDetail) {
            $notiDetail->latest_status = self::getLatestStatusByNotiRepairId($notirepaitid);
        }
        return $notiDetail;
    }
    public static function getItemComplte(){
        return Statustracking::select('status','notirepairId')->where('status','=','ได้รับของเเล้ว')->get();
    }


 


 




}

