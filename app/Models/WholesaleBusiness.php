<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WholesaleBusiness extends Authenticatable
{
    use Notifiable;
    protected $table = 'wholesales_business';

    protected $guard = 'wholesalebusiness';

    protected $fillable = [
        'partner_id', 'name', 'username', 'tel', 'password', 'password_name', 'role', 'status', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
