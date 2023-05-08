<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'cost', 'house_id'];

    public function house() :BelongsTo
    {
        return $this->belongsTo( House::class );
    }

    public function payments()
    {
        return $this->morphMany( Payment::class, 'payable' );
    }

    public function tenant()
    {
        return  $this->morphOne( Tenant::class, 'tenable' )->where('deleted_at',  null );
    }
}
