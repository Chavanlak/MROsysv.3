<?php
namespace App\Repository;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\BinaryOp\Equal;

class EquipmentRepository{
    public static function getallEquipment(){
        return Equipment::all();
    }
    public static function getequipmentById($TypeId){
        return Equipment::where('TypeId', $TypeId)->get();
    }
    public static function getEquipmentnameByID($equipId){
    return Equipment::select(['equipmentName'])->where('equipmentId','=',$equipId)->first();
}
//CRUD

    // public static function AddEquipment(){
    //     return Equipment::insert('equipmentId');
    // }
    public static function addEquipment($equimentValue,$TypeId){
        $equiment = new Equipment();
        $equiment->equipmentName = $equimentValue;
        $equiment->TypeId = $TypeId;
        $equiment->save();
        return $equiment;
    }
    public static function editEquipment(){

    }
    // public static function deleteEquipment(){
    //     return Equipment::deleted('EquuipmentId');
    // }
    public static function getAllDataWithTypename(){
        return Equipment::leftJoin('equipmenttype','equipment.TypeId','=','equipmenttype.TypeId')
        ->select('equipment.*','equipmenttype.TypeName')->get();
  
    }
    public static function deleteEquipment($equipmentId){
        return Equipment::destroy($equipmentId);
    }

}
?>
