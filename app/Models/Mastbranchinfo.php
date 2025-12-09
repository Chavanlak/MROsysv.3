<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastbranchinfo extends Model
{
    protected $table = 'mastbranchinfo';
    protected $primaryKey = 'MBranchInfo_Code ';
    public $timestamps = false;

    public $connection = 'secondary';
    use HasFactory;
}
