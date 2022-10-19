<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserRequest extends Model
{

    protected $fillable = [
        'user_id',
        'profile_id',
        'type'
    ];

}
