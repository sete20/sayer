<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custody extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','company_asset_id','quantity','delivery_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company_asset()
    {
        return $this->belongsTo(companyAsset::class,'company_asset_id','id');
    }
}
