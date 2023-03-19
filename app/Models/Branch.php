<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class Branch extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use BelongsToThrough;

    protected $fillable = ['name', 'ward_id'];

    public function region()
    {
        return $this->belongsToThrough( Region::class, [ District::class, Council::class, Division::class, Ward::class]);
    }

    public function district()
    {
        return $this->belongsToThrough(District::class, [Council::class, Division::class, Ward::class]);
    }

    public function council()
    {
        return $this->belongsToThrough(Council::class, [ Division::class, Ward::class ] );
    }

    public function division()
    {
        return $this->belongsToThrough( Division::class, Ward::class );
    }
    /**
     * Get the ward that owns the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class );
    }

    /**
     * @return HasMany
     */
    public function trunks():HasMany
    {
        return $this->hasMany( Trunk::class );
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
