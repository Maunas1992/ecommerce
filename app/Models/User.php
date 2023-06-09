<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Feedback;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'address',
        'dob',
        // 'city',
        'gender',
        // 'state',
        // 'country',
        'country_id',
        'state_id',
        'city_id',
        'pincode',
        'mobile_no',
        'email',
        'password',
        'status',
        'role',
    ];

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

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id','user_id');
    }
    public function productswishlist()
    {
        return $this->hasMany(Product::class,'id','user_id');
    }
    public function country() {
        return $this->belongsTo(Country::class, 'country_id','id');
    }
    public function state() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
