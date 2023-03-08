<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorModel extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'motor_type_id'];


    public function motor_type()
    {
        return $this->belongsTo(MotorType::class);
    }
}
