<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function motor_types()
    {
    	return $this->hasMany( MotorType::class );
    }
}
