<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
class User extends Model
{
    // use Notifiable;

    protected $fillable = [
        'staffname',
        'staffpassword',
    ];
    protected $table = 'staff_rc';

    // protected $hidden = [
    //     'staffpassword',
    // ];
    public $timestamps = false;
}
