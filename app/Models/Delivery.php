<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id','user_id','consignee','track_delivery_number',
        'consignee_phone','consignee_telephone',
        'consignee_address','country_id','city_id',
        'state_id','service_id','status','received_date',
        'package_number','weight_in_kilo','delivery_amount_from',
        'home_number','notes','coupon_code',
        'total_price','order_price','order_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function representative()
    {
        return $this->hasMany(UserDelivery::class,'delivery_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function notes()
    {
        return $this->belongsToMany(DeliveryNote::class,'deliveries_notes','delivery_note_id','delivery_id');
    }

    public function verifyOrderStatus()
    {
        return $this->hasMany(VerifyOrderStatus::class,'order_id','id');
    }

}
