<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['houseName', 'location', 'house_type_id'];

    public function apartments() :HasMany
    {
        return $this->hasMany( Apartment::class );
    }

    public function payments() :HasManyThrough
    {
        return $this->hasManyThrough( Payment::class, Apartment::class );
    }

    public function house_type()
    {
        return $this->belongsTo( HouseType::class );
    }

}
