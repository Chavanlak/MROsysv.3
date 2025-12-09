<?php


namespace App\Repository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserRepository{
    public static function getAllUsers(){
        return User::all();
    }
    public function getStaffUser(){
        return User::where('staffname')->get();
    }
    public static function getStaffPassword($staffname){
        return User::where('staffname', $staffname)->value('staffpassword');
    }
    
  
}
?>