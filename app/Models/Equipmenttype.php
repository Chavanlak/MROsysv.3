<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipmenttype extends Model
{
    protected $table = 'equipmenttype';
    protected $primaryKey = 'TypeId';

    public $timestamps = false;
    public $connection = 'third';
    use HasFactory;
}
