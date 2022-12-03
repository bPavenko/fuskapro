<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Model
{

    protected $fillable = [
        'order_id',
        'user_id',
        'from',
        'notification',
        'type',
        'shown'
    ];

    public function from_user () {
        return $this->hasOne(User::class, 'id', 'from');
    }

}
