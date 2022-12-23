<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;


class TaskSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'image'
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
        return url('/admin/task-sections/'.$this->getKey());
    }

    public function categories()
    {
        return $this->hasMany(TaskCategory::class, 'parent_id', 'id');
    }

    public function orders ()
    {
        return $this->hasMany(Order::class, 'section_id', 'id');
    }

    public function getImagePathAttribute() {
        if ($this->image) {
            return asset('storage/images/' . $this->image);
        } else {
            return asset('img/pin.png');
        }
    }
}
