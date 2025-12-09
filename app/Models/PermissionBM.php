<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionBM extends Model
{
    protected $table = 'permission_bm';
    // protected $primaryKey = 'staffcode';
       protected $primaryKey = 'id';
    public $timestamps = false;
    use HasFactory;
}
