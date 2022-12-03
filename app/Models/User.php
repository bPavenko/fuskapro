<?php

namespace App\Models;

use Egulias\EmailValidator\Exception\AtextAfterCFWS;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Igaster\LaravelCities\Geo;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'surname',
        'city',
        'type_id',
        'about_me',
        'last_seen',
        'rate',
        'avatar',
        'delete_request',
        'vip_status',
        'priority',
        'provider_name',
        'provider_id',
        'balance'
    ];
    protected $appends = ['resource_url'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class,  'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class,  'user_id', 'id');
    }

    public function portfolio()
    {
        return $this->hasMany(UserPortfolio::class,  'user_id', 'id');
    }


    public function categories() {
        return $this->belongsToMany(TaskCategory::class, UserCategories::class, 'user_id', 'category_id', 'id');
    }

    public function isAuthor($orderId) {
        $order = Order::find($orderId);
        return $order->by_user == $this->id ? true : false;
    }

    public function isExecutor($orderId) {
        $order = Order::find($orderId);
        return $order->executor_id == $this->id ? true : false;
    }

    public function isSpecialist() {
        return $this->type_id == 2 ? true : false;
    }

    public function getCategoriesIds() {
        return UserCategories::where('user_id', $this->id)->pluck('category_id')->toArray();
    }

    public function lastSeen() {
        $seconds = abs(strtotime("now") - strtotime($this->last_seen));

        if (strtotime($this->last_seen) > strtotime("-20 minutes")) {
            return trans('main.online');
        } else if (strtotime($this->last_seen) > strtotime("-24 hours")) {
            $hours = floor($seconds / (60 * 60));
            if ($hours != 0.0) {
                return trans('main.was_on_site') . ' ' . $hours . ' ' . trans('main.hours_ago');
            } else {
                return trans('main.was_on_site') . ' ' . floor($seconds / (60)) . ' ' . trans('main.minutes_ago');
            }
        } else if (strtotime($this->last_seen) > strtotime("- 1 month")) {
            $days = floor($seconds / (60 * 60 * 24));
            return trans('main.was_on_site') . ' ' . $days . ' ' . trans('main.days_ago');
        } else if (strtotime($this->last_seen) > strtotime("- 1 year")) {
            $months = floor($seconds / (60 * 60 * 24 * 30));
            return trans('main.was_on_site') . ' ' . $months . ' ' . trans('main.months_ago');
        } else if (strtotime($this->last_seen) < strtotime("- 1 year")) {
            $months = floor($seconds / (60 * 60 * 24 * 365));
            return trans('main.was_on_site') . ' ' . $months . ' ' . trans('main.years_ago');
        }
    }

    public function getRate() {
        if ($this->rate) {
            return $this->rate;
        }
        $rates = Rate::where('user_id', $this->id)->pluck('rate')->toArray();
        if ($rates) {
            return number_format(array_sum($rates) / count($rates), 1);
        } else {
            return  '-';
        }

    }
    public function getCityNameAttribute () {
        $geo = Geo::find($this->city);
        if ($geo) {
            return $geo->name;
        }
        return '';
    }

    public function getTypeAttribute() {
        return $this->type_id == 2 ? 'executor' : 'user';
    }

    public function closedOrders() {
        $orders = Order::where('executor_id', $this->id)->where('status', 'closed')->get();

        return count($orders);
    }

    public function activeOrders() {
        $orders = Order::where('executor_id', $this->id)->where('status', 'progress')->get();

        return count($orders);
    }

    public function checkRequest($profileId = null, $type) {
        if ($type == 'show' && Auth::user()->vip_status) {
            return true;
        }
        if ($profileId) {
            if ($type == 'show') {
                $order = Order::where('by_user', Auth::user()->id)->where('executor_id', $profileId)->first();
                if ($order) {
                    return  true;
                }
            }
            $request = UserRequest::where('user_id', $this->id)
                ->where('profile_id', $profileId)
                ->where('type', $type)
                ->get()
                ->toArray();
        }

        return $request ? true : false;
    }

    public function showContacts($profileId = null, $type = null) {

    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/users/'.$this->getKey());
    }

    public function getAvatarPathAttribute() {
        if(stristr($this->avatar, 'https://')){
            return $this->avatar;
        } else {
            return asset('storage/images/' . $this->avatar);
        }
    }

    public function getNewNotificationsAttribute() {
        $newNotifications = Notification::where('user_id', Auth::user()->id)->where('shown', 0)->get();
        if (count($newNotifications)) {
            return true;
        } else {
            return false;
        }
    }
}
