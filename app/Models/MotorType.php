<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'motor_category_id'];


    public function motor_models()
    {
        return $this->hasMany( MotorModel::class );
    }

    public function MotorCategory()
    {
    	return $this->belongsTo(MotorCategory::class);
    }
}
