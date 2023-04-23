<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'owner_id', 'garage_id'];

    public function services()
    {
        return $this->belongsToMany( Service::class, 'service_service_type' )
            ->withPivot(['cost', 'prevCost', 'itemCount'])
            ->withTimestamps();
    }

    public function owner(){
        return $this->belongsTo( Owner::class);
    }

    public function garage()
    {
    return $this->belongsTo(Garage::class );
    }
}
