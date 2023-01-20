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
        'balance',
        'country_code'
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
    public function countriesList() {
        return [
            "ax" => "Aland Islands",
            "al" => "Albania",
            "dz" => "Algeria",
            "as" => "American Samoa",
            "ad" => "Andorra",
            "ao" => "Angola",
            "ai" => "Anguilla",
            "ag" => "Antigua",
            "ar" => "Argentina",
            "am" => "Armenia",
            "aw" => "Aruba",
            "au" => "Australia",
            "at" => "Austria",
            "az" => "Azerbaijan",
            "bs" => "Bahamas",
            "bh" => "Bahrain",
            "bd" => "Bangladesh",
            "bb" => "Barbados",
            "by" => "Belarus",
            "be" => "Belgium",
            "bz" => "Belize",
            "bj" => "Benin",
            "bm" => "Bermuda",
            "bt" => "Bhutan",
            "bo" => "Bolivia",
            "ba" => "Bosnia",
            "bw" => "Botswana",
            "bv" => "Bouvet Island",
            "br" => "Brazil",
            "vg" => "British Virgin Islands",
            "bn" => "Brunei",
            "bg" => "Bulgaria",
            "bf" => "Burkina Faso",
            "ar" => "Burma",
            "bi" => "Burundi",
            "tc" => "Caicos Islands",
            "kh" => "Cambodia",
            "cm" => "Cameroon",
            "ca" => "Canada",
            "cv" => "Cape Verde",
            "ky" => "Cayman Islands",
            "cf" => "Central African Republic",
            "td" => "Chad",
            "cl" => "Chile",
            "cn" => "China",
            "cx" => "Christmas Island",
            "cc" => "Cocos Islands",
            "co" => "Colombia",
            "km" => "Comoros",
            "cg" => "Congo Brazzaville",
            "cd" => "Congo",
            "ck" => "Cook Islands",
            "cr" => "Costa Rica",
            "ci" => "Cote Divoire",
            "hr" => "Croatia",
            "cu" => "Cuba",
            "cy" => "Cyprus",
            "cz" => "Czech Republic",
            "dk" => "Denmark",
            "dj" => "Djibouti",
            "dm" => "Dominica",
            "do" => "Dominican Republic",
            "ec" => "Ecuador",
            "eg" => "Egypt",
            "sv" => "El Salvador",
            "gb" => "England",
            "gq" => "Equatorial Guinea",
            "er" => "Eritrea",
            "ee" => "Estonia",
            "et" => "Ethiopia",
            "eu" => "European Union",
            "fk" => "Falkland Islands",
            "fo" => "Faroe Islands",
            "fj" => "Fiji",
            "fi" => "Finland",
            "fr" => "France",
            "gf" => "French Guiana",
            "pf" => "French Polynesia",
            "tf" => "French Territories",
            "ga" => "Gabon",
            "gm" => "Gambia",
            "ge" => "Georgia",
            "de" => "Germany",
            "gh" => "Ghana",
            "gi" => "Gibraltar",
            "gr" => "Greece",
            "gl" => "Greenland",
            "gd" => "Grenada",
            "gp" => "Guadeloupe",
            "gu" => "Guam",
            "gt" => "Guatemala",
            "gw" => "Guinea-Bissau",
            "gn" => "Guinea",
            "gy" => "Guyana",
            "ht" => "Haiti",
            "hm" => "Heard Island",
            "hn" => "Honduras",
            "hk" => "Hong Kong",
            "hu" => "Hungary",
            "is" => "Iceland",
            "in" => "India",
            "io" => "Indian Ocean Territory",
            "id" => "Indonesia",
            "ir" => "Iran",
            "iq" => "Iraq",
            "ie" => "Ireland",
            "il" => "Israel",
            "it" => "Italy",
            "jm" => "Jamaica",
            "jp" => "Japan",
            "jo" => "Jordan",
            "kz" => "Kazakhstan",
            "ke" => "Kenya",
            "ki" => "Kiribati",
            "kw" => "Kuwait",
            "kg" => "Kyrgyzstan",
            "la" => "Laos",
            "lv" => "Latvia",
            "lb" => "Lebanon",
            "ls" => "Lesotho",
            "lr" => "Liberia",
            "ly" => "Libya",
            "li" => "Liechtenstein",
            "lt" => "Lithuania",
            "lu" => "Luxembourg",
            "mo" => "Macau",
            "mk" => "Macedonia",
            "mg" => "Madagascar",
            "mw" => "Malawi",
            "my" => "Malaysia",
            "mv" => "Maldives",
            "ml" => "Mali",
            "mt" => "Malta",
            "mh" => "Marshall Islands",
            "mq" => "Martinique",
            "mr" => "Mauritania",
            "mu" => "Mauritius",
            "yt" => "Mayotte",
            "mx" => "Mexico",
            "fm" => "Micronesia",
            "md" => "Moldova",
            "mc" => "Monaco",
            "mn" => "Mongolia",
            "me" => "Montenegro",
            "ms" => "Montserrat",
            "ma" => "Morocco",
            "mz" => "Mozambique",
            "na" => "Namibia",
            "nr" => "Nauru",
            "np" => "Nepal",
            "an" => "Netherlands Antilles",
            "nl" => "Netherlands",
            "nc" => "New Caledonia",
            "pg" => "New Guinea",
            "nz" => "New Zealand",
            "ni" => "Nicaragua",
            "ne" => "Niger",
            "ng" => "Nigeria",
            "nu" => "Niue",
            "nf" => "Norfolk Island",
            "kp" => "North Korea",
            "mp" => "Northern Mariana Islands",
            "no" => "Norway",
            "om" => "Oman",
            "pk" => "Pakistan",
            "pw" => "Palau",
            "ps" => "Palestine",
            "pa" => "Panama",
            "py" => "Paraguay",
            "pe" => "Peru",
            "ph" => "Philippines",
            "pn" => "Pitcairn Islands",
            "pl" => "Poland",
            "pt" => "Portugal",
            "pr" => "Puerto Rico",
            "qa" => "Qatar",
            "re" => "Reunion",
            "ro" => "Romania",
            "ru" => "Russia",
            "rw" => "Rwanda",
            "sh" => "Saint Helena",
            "kn" => "Saint Kitts and Nevis",
            "lc" => "Saint Lucia",
            "pm" => "Saint Pierre",
            "vc" => "Saint Vincent",
            "ws" => "Samoa",
            "sm" => "San Marino",
            "gs" => "Sandwich Islands",
            "st" => "Sao Tome",
            "sa" => "Saudi Arabia",
            "sn" => "Senegal",
            "cs" => "Serbia",
            "rs" => "Serbia",
            "sc" => "Seychelles",
            "sl" => "Sierra Leone",
            "sg" => "Singapore",
            "sk" => "Slovakia",
            "si" => "Slovenia",
            "sb" => "Solomon Islands",
            "so" => "Somalia",
            "za" => "South Africa",
            "kr" => "South Korea",
            "es" => "Spain",
            "lk" => "Sri Lanka",
            "sd" => "Sudan",
            "sr" => "Suriname",
            "sj" => "Svalbard",
            "sz" => "Swaziland",
            "se" => "Sweden",
            "ch" => "Switzerland",
            "sy" => "Syria",
            "tw" => "Taiwan",
            "tj" => "Tajikistan",
            "tz" => "Tanzania",
            "th" => "Thailand",
            "tl" => "Timorleste",
            "tg" => "Togo",
            "tk" => "Tokelau",
            "to" => "Tonga",
            "tt" => "Trinidad",
            "tn" => "Tunisia",
            "tr" => "Turkey",
            "tm" => "Turkmenistan",
            "tv" => "Tuvalu",
            "ug" => "Uganda",
            "ua" => "Ukraine",
            "ae" => "United Arab Emirates",
            "us" => "United States",
            "uy" => "Uruguay",
            "um" => "Us Minor Islands",
            "vi" => "Us Virgin Islands",
            "uz" => "Uzbekistan",
            "vu" => "Vanuatu",
            "va" => "Vatican City",
            "ve" => "Venezuela",
            "vn" => "Vietnam",
            "wf" => "Wallis and Futuna",
            "eh" => "Western Sahara",
            "ye" => "Yemen",
            "zm" => "Zambia",
            "zw" => "Zimbabwe",
        ];
    }
}
