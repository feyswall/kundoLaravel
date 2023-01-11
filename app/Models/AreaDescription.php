<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaDescription extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'area_id'];

    public function area(){
        return $this->belongsTo( Area::class );
    }
}
