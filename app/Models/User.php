<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens; // include this

class User extends Authenticatable
{
    use  HasFactory, Notifiable, LaratrustUserTrait, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'phone',
        'type',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        switch ($this->type) {
            case 1:
            case 2:
                return $this->hasOne(EmployeeIndividualProfile::class,'user_id','id');
            case 3:
                return $this->hasOne(CompanyProfile::class,'user_id','id');
            case 4:
                return $this->hasOne(PersonalProfile::class,'user_id','id');
            default:
                return null;
        }
    }

    public function commissions()
    {
        return $this->hasMany(UserCommission::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
