<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['motor_id'];

    public function motor()
    {
        return $this->belongsTo( Motor::class );
    }

    public function garage()
    {
        return $this->belongsToMany( Garage::class );
    }

    public function service_types()
    {
        return $this->belongsToMany( ServiceType::class, 'service_service_type' );
    }
}
