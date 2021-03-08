<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCost extends Model
{
    use HasFactory;
    protected $fillable = ['service_id','state_id','cost'];
}
