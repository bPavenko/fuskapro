<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class TaskCategory extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'parent_id',
    
    ];
    public $translatable = ['name'];


    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/task-categories/'.$this->getKey());
    }

    public function section()
    {
        return $this->belongsTo(TaskSection::class, 'parent_id', 'id');
    }

    public function orders ()
    {
        return $this->hasMany(Order::class, 'category_id', 'id');
    }
}
