<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class Admin extends AuthenticatableUser implements Authenticatable
{

    use HasFactory, Notifiable;
    protected $table = 'admins';
    protected $guarded =['id'];
}
