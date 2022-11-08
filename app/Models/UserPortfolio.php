<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserPortfolio extends Model
{
    protected $table = 'user_portfolio';
    protected $fillable = [
        'user_id',
        'path',
        'type',
        'description',
        'section_id',
        'category_id'
    ];

    public function getVideoIdAttribute() {
       preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->path, $match);
       return $match[1];
    }

    public function getThumbnailAttribute() {
        return 'https://img.youtube.com/vi/' . $this->video_id . '/mqdefault.jpg';
    }

}
