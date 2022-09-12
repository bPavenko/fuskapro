<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderRequest extends Model
{

    protected $fillable = [
        'order_id',
        'executor_id'
    ];

    public function executor () {
        return $this->hasOne(User::class, 'id', 'executor_id');
    }
}
