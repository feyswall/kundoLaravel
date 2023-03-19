<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class Ward extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use BelongsToThrough;

    protected  $fillable = ['name', 'division_id'];

    public function region()
    {
        return $this->belongsToThrough(Region::class, [ District::class, Council::class, Division::class]);
    }


    public function district()
    {
        return $this->belongsToThrough(District::class, [Council::class, Division::class]);
    }

    public function council()
    {
        return $this->belongsToThrough(Council::class, Division::class );
    }

    public function division()
    {
        return $this->belongsTo( Division::class );
    }

    /**
     * Get the branch that owns the Ward
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function trunks()
    {
        return $this->hasManyThrough( Trunk::class, Branch::class );
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
