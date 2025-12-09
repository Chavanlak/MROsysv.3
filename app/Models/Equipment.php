<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'equipmentId';
    public $connection = 'third';
    public $timestamps = false;
    use HasFactory;
}
