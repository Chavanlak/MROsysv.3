<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notirepair extends Model
{
    protected $table = 'notirepair';
    protected $primaryKey = 'NotirepairId';
    public $connection = 'third';
    public $timestamps = false;
    public function statusTracking()
    {
        // Notirepair (NotirepairId) มีความสัมพันธ์กับ Statustracking (NotirepairId)
        // 💡 ตรวจสอบให้แน่ใจว่า:
        //    - Statustracking model มีอยู่จริง (คุณอาจต้องสร้างมัน)
        //    - Foreign Key ในตาราง statustracking คือ 'NotirepairId'
        return $this->hasMany(Statustracking::class, 'NotirepairId', 'NotirepairId')
                    ->orderBy('statusDate', 'desc'); // ดึงสถานะล่าสุดมาไว้บนสุด
    }
    
    // 💡 แนะนำให้เพิ่มความสัมพันธ์สำหรับสถานะล่าสุด (เผื่อใช้บ่อย)
    public function latestStatus()
    {
        return $this->hasOne(Statustracking::class, 'NotirepairId', 'NotirepairId')
                    ->latest('statustrackingId'); // ใช้ latest() เพื่อดึงรายการที่มี ID มากที่สุด (ล่าสุด)
    }
    use HasFactory;
}
