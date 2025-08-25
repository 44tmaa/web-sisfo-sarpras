<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // opsional, jika pakai auth guard

    protected $fillable = [
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
