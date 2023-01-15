<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Council extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'district_id'];

    /**
     * Get the district that owns the Council
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get all of the division for the Council
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }

    /**
     * The leaders that belong to the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class)->withPivot('isActive', 'post_id');
    }
}
