<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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


    /**
     * @return HasManyThrough
     */
    public function branches(): HasManyThrough
    {
        return $this->hasManyThrough(Branch::class, Ward::class );
    }



    /**
     * The leaders that belong to the Ward
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class)->withPivot('isActive', 'post_id');
    }
}
