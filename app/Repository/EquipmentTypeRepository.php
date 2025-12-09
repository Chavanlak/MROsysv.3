<?php
namespace App\Repository;
use App\Models\Equipmenttype;
use App\Models\Equipment;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;

class EquipmentTypeRepository{
    public static function getallEquipmentType(){
        return Equipmenttype::all();
    }
    public static function getEmailRepairById($emailRepairId){
        return Equipmenttype::where('emailRepairId', $emailRepairId)->get();
    }
    // public static function getEquipmentnameByID($equipId){
    //     return Equipment::select(['equipmentName'])->where('equipmentId','=',$equipId)->first();
    // }
    // public static function getEmailRepair(){
    //     return Equipmenttype::select('emailrepair.emailRepairId','emailrepair.emailRepair'
    //     ,'equipmenttype.TypeName')
    //     ->join('emailrepair','equipmenttype.emailRepairId','=','emailrepair.emailRepairId')
    //     ->orderBy('equipmenttype.TypeId')
    //     ->orderBy('emailrepair.emailRepairId')
    //     ->get();
    // }
    public static function getEmailRepair($typeId)
    {
        return Equipmenttype::select(
                'emailrepair.emailRepairId',
                'emailrepair.emailRepair',
                'equipmenttype.TypeName'
            )
            ->join('emailrepair','equipmenttype.emailRepairId','=','emailrepair.emailRepairId')
            ->where('equipmenttype.TypeId', $typeId)  
            ->first();  
    }
    public static function getemailRepairId($emailRepairId){
        return Equipmenttype::where('emailRepairId',1,$emailRepairId)->first();
    }
    //crud Admin
    // public static function addEquipmenttype(){
    //     return Equipmenttype::insert();
    // }
    public static function addEquipmenttype($equipmenttypeValue,$emailRepairId){
        $equipmenttype = new Equipmenttype();
        $equipmenttype->emailRepairId = $emailRepairId;
        $equipmenttype->TypeName = $equipmenttypeValue;
        $equipmenttype->save();
        return $equipmenttype;

    }
    public static function editEquipmenttype(){
        
    }
    public static function deleteEqiupmenttype(){
        return Equipmenttype::deleted('EquipmenttypeId');
    }


}
?>
