<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost'];

    public function services()
    {
        return $this->belongsToMany( Service::class, 'service_service_type' );
    }
}
