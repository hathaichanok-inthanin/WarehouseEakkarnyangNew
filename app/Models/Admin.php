<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = [
        'admin_id', 'name', 'username', 'password', 'password_name', 'role', 'status', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
