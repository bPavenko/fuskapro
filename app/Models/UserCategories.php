<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserCategories extends Model
{

    protected $fillable = [
        'user_id',
        'category_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(TaskCategory::class);
    }

}
