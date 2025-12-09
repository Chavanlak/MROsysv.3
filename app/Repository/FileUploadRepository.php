<?php
namespace App\Repository;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\FileUpload;
class FileUploadRepository{
   public static function gaetallFile(){
    return File::all();
   }
   public static function getFileById($FileUploadId ){
    return File::where('FileUploadId', $FileUploadId)->first();
   }
//    public static function UploadeFile($FileUploadId,$Name,$Size,$Location){
//     $FileUploadId = new File();
//     $FileUploadId->FileUploadId = $FileUploadId;
//     $FileUploadId->Name = $Name;
//     $FileUploadId->Size = $Size;
//     $FileUploadId->Location = $Location;
//     // $FileUploadId->save();
//    }


public static function getPicturebyNotiRepairId($NotirepairId){
        $picList = FileUpload::select(['FileUpload.filepath'])->where('FileUpload.NotirepairId','=',$NotirepairId)->get();
        return $picList;
    }


}


?>
