<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminReviewer extends Model
{
    protected $fillable = [
        'name',
        'profession',
        'review',
        'avatar'
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/admin-reviewers/'.$this->getKey());
    }

    public function getImagePathAttribute() {
        return asset('storage/images/' . $this->avatar);
    }
}
