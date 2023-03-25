<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Image_banners extends Model
{
    use HasFactory, Notifiable;
    use Uuid;
    public $table = "image_banner";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id' , 'merchant','index', 'content_type', 'name', 'status', 'preview_image', 'updated_at', 'created_at'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = [];
}