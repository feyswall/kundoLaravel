<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'district_id'];

    /**
     * Get the region that owns the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class );
    }


    /**
     * Get the district that owns the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class );
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function challenges() {
        return $this->hasMany(Challenge::class);
    }



    /**
     * The leaders  that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders()
    {
        return $this->belongsToMany(Leader::class )->withPivot('isActive', 'post_id');
    }
}
