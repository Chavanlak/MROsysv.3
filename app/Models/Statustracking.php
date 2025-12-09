<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repository\TrackingStatus; 
//มองหาคลาส enum ที่เก็บสถานะในโฟลเดอร์ Repository
// use App\Enums\TrackingStatus;
// use Illuminate\Database\Eloquent\Casts\TrackingStatus;
// use Illuminate\Database\Eloquent\Casts\AsStringable;
// use Illuminate\Database\Eloquent\Casts\TrackingStatusEnum;
use App\Repository\TrackingStatusEnum;
class Statustracking extends Model
{
    protected $table = 'statustracking';

    protected $primaryKey = 'statustrackingId';
    public $timestamps = false;
    public $connection = 'third';

    protected $casts =[
        'status' => 'string',
         // 'status' => statustracking::class,
        // 'status' => AsStringable::class,
        // 'status' => TrackingStatusEnum::class,
        
       

    ];
    // public function notirepair()
    // {
    //     return $this->belongsTo(Notirapair::class, 'NotirepairId', 'NotirepairId');
    // }

    use HasFactory;
}
