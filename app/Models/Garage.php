<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'name', 'phone', 'email'];

    public function region()
    {
        return $this->belongsTo( Region::class );
    }

    public function service_types()
    {
        return $this->hasMany( ServiceType::class );
    }

    public function services()
    {
        return $this->hasMany( Service::class );
    }
}
