<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected  $fillable = ['name'];

    /**
     * Get all of the districts for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class );
    }


    /**
     * Get all of the leaders for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class )->withPivot('isActive', 'post_id');;
    }

}
