<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskSection extends Model
{
    protected $fillable = [
        'name',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/task-sections/'.$this->getKey());
    }

    public function categories()
    {
        return $this->hasMany(TaskCategory::class, 'parent_id', 'id');
    }
}
