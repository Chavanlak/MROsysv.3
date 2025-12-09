<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emailrepair extends Model
{
    protected $table = 'emailrepair';
    protected $primaryKey = 'emailrepairId';
    public $connection = 'third';
    public $timestamps = false;
    use HasFactory;
}
