<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationsLink extends Model
{
    protected $fillable = [
        'name',
        'url'
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/applications-links/'.$this->getKey());
    }
}
