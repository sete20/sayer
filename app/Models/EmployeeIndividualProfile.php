<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeIndividualProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar','name_en','started_job_at',
        'drive_license_number','drive_license_end_at','user_id',
        'drive_license_photo','phone_number','email','country_id',
        'national_license_number','national_license_end_at',
        'national_license_photo','passport_number','passport_photo',
        'passport_end_at','residence_end_at','residence_photo',
        'delivery_commission','receiving_commission','personal_photo'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
