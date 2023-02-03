<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class ShowComponent extends Model
{

    protected $fillable = [
        'component_name',
        'is_show',
    ];

    public function isMobileBlockShow() {
        $component = ShowComponent::where('component_name', 'mobile-block')->first();
         return $component->is_show;
    }

}
