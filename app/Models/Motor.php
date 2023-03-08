<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{

    use HasFactory;


    protected $fillable = ['motor_type_id', 'identity_name', 'color', 'year', 'owner_id', 'motor_model_id', 'motor_category_id'];

    public function owner()
    {
        return $this->belongsTo(Owner::class)->where('deleted_at', null);
    }

    public function motor_type()
    {
        return $this->belongsTo(MotorType::class);
    }

    public function motor_category()
    {
        return $this->belongsTo(MotorCategory::class );
    }

    public function motor_model()
    {
        return $this->belongsTo( MotorModel::class );
    }

    public function services()
    {
        return $this->hasMany( Service::class );
    }
}
