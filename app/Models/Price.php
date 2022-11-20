<?php

namespace App\Models;

use Brackets\Translatable\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasTranslations;

    protected $fillable = [
        'service',
        'cost',
    
    ];
    public $translatable = ['service'];
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/prices/'.$this->getKey());
    }

    public function vipCost() {
        return Price::find(1)->cost;
    }

    public function contactShowText() {
        return trans('main.cost_per_action') . ' ' . Price::find(3)->cost . ' ' . trans('main.coins');
    }
}
