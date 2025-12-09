<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // public $timestamps = false; 
    // protected $primaryKey = 'FileUploadId';

    // protected $table = 'fileupload';
    // public $connection = 'third';
    
      public $timestamps = false; 
    protected $primaryKey = 'testuploadfileId ';

    protected $table = 'testuploadfile';
    protected $fillable = [
        'testuploadfileId',
        'fileName',
        'fileOGName'
       
    ];
    public $connection = 'third';
    
    use HasFactory;
}
