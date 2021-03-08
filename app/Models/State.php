<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','country_id','city_id','status'];
    public $timestamps = false;

    public function country (){
        return $this->belongsTo(Country::class);
    }

    public function city (){
        return $this->belongsTo(City::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'service_costs','state_id','service_id');
    }
}
