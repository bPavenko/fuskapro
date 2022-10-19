<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'section_id',
        'category_id',
        'short_description',
        'full_description',
        'execution_date',
        'start_execution_time',
        'end_execution_time',
        'price',
        'by_user',
        'price_negotiable',
        'city',
        'executor_id',
        'status',
        'title',
        'count_views'
    ];
    
    
    protected $dates = [
        'execution_date',
        'start_execution_time',
        'end_execution_time',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/orders/'.$this->getKey());
    }

    public function section()
    {
        return $this->belongsTo(TaskSection::class);
    }

    public  function order_requests()
    {
        return $this->hasMany(OrderRequest::class);
    }

    public function executor() {
        return $this->hasOne(User::class, 'id', 'executor_id');
    }

    public function author() {
        return $this->hasOne(User::class, 'id', 'by_user');
    }

    public function checkRequest($executorId = null, $type) {
        if (!$executorId) {
            $order = OrderRequest::where('order_id', $this->id)
                ->where('type', $type)
                ->get()
                ->toArray();
        } else {
            $order = OrderRequest::where('order_id', $this->id)
                ->where('executor_id', $executorId)
                ->where('type', $type)
                ->get()
                ->toArray();
        }


        return $order ? true : false;
    }
}
