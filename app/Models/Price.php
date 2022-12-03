<?php

namespace App\Models;

use App\Models\User;
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
    public function orderCost() {
        return Price::find(2)->cost;
    }
    public function contactCost($id) {
        $user = User::find($id);
        if ($user->type_id == 1) {
            return Price::find(3)->cost;
        } else {
            return Price::find(4)->cost;
        }
    }
    public function contactShowText($id) {
        $user = User::find($id);
        if ($user->type_id == 1) {
            $price =  Price::find(3)->cost;
        } else {
            $price =  Price::find(4)->cost;
        }
        return trans('main.cost_per_action') . ' ' . $price . ' ' . trans('main.coins');
    }
}
