<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Znck\Eloquent\Traits\BelongsToThrough;

class Division extends Model
{
    use HasFactory;
    use BelongsToThrough;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected  $fillable = ['name', 'council_id'];


    public function region()
    {
        return $this->belongsToThrough( Region::class, [District::class, Council::class] );
    }

    public function district()
    {
        return $this->belongsToThrough( District::class, Council::class );
    }

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
     * The long relations starts here and now
     */
    public function trunks(){
        return $this->hasManyDeep(Trunk::class, [Ward::class, Branch::class ]);
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
