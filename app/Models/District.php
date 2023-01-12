<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'region_id'];

    /**
     * Get the region that owns the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class );
    }

    /**
     * Get all of the council for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function divisions(): HasManyThrough
    {
        return $this->hasManyThrough(Division::class,Council::class);
    }

    public function councils()
    {
        return $this->hasMany(Council::class);
    }
}
