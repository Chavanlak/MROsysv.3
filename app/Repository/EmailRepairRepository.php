<?php
namespace App\Repository;
// use App\Models\Equipment;
use App\Models\EmailRepair;
use App\Models\Emailrepair as ModelsEmailrepair;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Email;

class EmailRepairRepository{
    public static function getAllEmailRepairs(){
        return EmailRepair::all();
    }
    public static function getEmailRepairById($id){
        return EmailRepair::find($id);
    }
    //CRUD Admindashbord
    // public static function AddEmailRepair($emailValue){
    //     return EmailRepair::created([
    //         'emailRepair' => $emailValue,
    //     ]);
    // }
    public static function AddEmailRepair($emailValue){
        $email = new EmailRepair();
        $email->emailRepair = $emailValue;
        $email->save();
        return $email;
        
    }
  
    public static function EditEmailRepair($EmailRepairId){
        return EmailRepair::where('EmailRepairId','=',$EmailRepairId)->first();
    }
    public static function UpdateEmailRepair($emailRepairId){
        return EmailRepair::update($emailRepairId);
    }
    public static function DeleteEmailRepair(){
        return EmailRepair::deleted('EmailrepairId');
    }

    
}


?>