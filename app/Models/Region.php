<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{

    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

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
     * The long relations starts here and now
     */
    public function councils(){
        return $this->hasManyDeep(Council::class, [District::class]);
    }

    /**
     * The long relations starts here and now
     */
    public function divisions(){
        return $this->hasManyDeep(Division::class, [District::class, Council::class]);
    }

    /**
     * The long relations starts here and now
     */
    public function wards(){
        return $this->hasManyDeep(Ward::class, [District::class, Council::class, Division::class]);
    }


    /**
     * The long relations starts here and now
     */
    public function branches(){
        return $this->hasManyDeep(Branch::class, [District::class, Council::class, Division::class, Ward::class]);
    }

        /**
     * The long relations starts here and now
     */
    public function trunks(){
        return $this->hasManyDeep(Trunk::class, [District::class, Council::class, Division::class, Ward::class, Branch::class ]);
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
