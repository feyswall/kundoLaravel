<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Council extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected  $fillable = ['name', 'district_id'];

    public function region()
    {
        return $this->belongsToThrough(Region::class, District::class);
    }


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
     * Get all of the division for the Council
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards(): HasManyThrough
    {
        return $this->hasManyThrough(Ward::class, Division::class);
    }



    public function branches(): HasManyDeep
    {
        return $this->hasManyDeep(Branch::class, [Division::class, Ward::class]);
    }


    public function trunks(): HasManyDeep
    {
        return $this->hasManyDeep(Trunk::class, [Division::class, Ward::class, Branch::class ]);
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
