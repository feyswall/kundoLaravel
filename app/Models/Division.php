<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'council_id'];

    /**
     * Get the council  that owns the Division
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class );
    }


    /**
     * Get all of the wards for the Division
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class );
    }
}
