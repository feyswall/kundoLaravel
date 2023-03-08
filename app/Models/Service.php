<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['garage_id'];

    public function service_type()
    {
        return $this->belongsToMany( ServiceType::class, 'service_service_type' );
    }
}
