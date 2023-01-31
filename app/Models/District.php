<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class District extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected  $fillable = ['name', 'region_id'];

    /**
     * Get the region that owns the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo( Region::class );
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


    /**
     * Get all of the states for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }


    /**
     * @return HasManyDeep
     */
    public function wards(): HasManyDeep
    {
        return $this->hasManyDeep(Ward::class, [Council::class, Division::class]);
    }



    /**
     * @return HasManyDeep
     */
    public function branches(): HasManyDeep
    {
        return $this->hasManyDeep(Branch::class, [Council::class, Division::class, Ward::class]);
    }


    /**
     * The leaders that belong to the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class)->withPivot('isActive', 'post_id');
    }
}
