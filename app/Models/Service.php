<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','type','status'];

    public function states()
    {
        return $this->belongsToMany(State::class,'service_costs','service_id','state_id');
    }

    public function relValue($stateId)
    {
        $serviceCost = ServiceCost::query()->where('service_id',$this->id)->where('state_id',$stateId)->first();
        if ($serviceCost !== null)
        {
            return $serviceCost->cost;
        } else {
            return 0;
        }
    }
}
