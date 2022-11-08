<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class FooterLink extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'footer_title_id',
        'link',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    public function title()
    {
        return $this->belongsTo(FooterTitle::class, 'footer_title_id', 'id');
    }
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/footer-links/'.$this->getKey());
    }
}
