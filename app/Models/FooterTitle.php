<?php

namespace App\Models;

use Brackets\Translatable\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class FooterTitle extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

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
        return url('/admin/footer-titles/'.$this->getKey());
    }

    public function links()
    {
        return $this->hasMany(FooterLink::class, 'footer_title_id', 'id');
    }
}
