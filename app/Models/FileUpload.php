<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'fileupload';
    protected $primaryKey = 'FileUploadId ';

    public $timestamps = false;
    public $connection = 'third';

    use HasFactory;
}
