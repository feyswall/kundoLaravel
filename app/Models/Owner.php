<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['name', 'gender', 'user_id'];

    public function motors(){
        return $this->hasMany( Motor::class );
    }

    public function user(){
        return $this->belongsTo( User::class );
    }

    public function service_types(){
        return $this->hasMany( ServiceType::class );
    }

    public function services()
    {
        return $this->hasMany( Owner::class );
    }
}
