<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Leader extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = ['firstName', 'middleName', 'lastName', 'phone'];

    
    /**
     * The regions that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class)->withPivot('isActive', 'post_id');
    }


    
    /**
     * The district that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(District::class)->withPivot('isActive', 'post_id');
    }


    /**
     * The council that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function councils(): BelongsToMany
    {
        return $this->belongsToMany(Council::class)->withPivot('isActive', 'post_id');
    }

    
    /**
     * The division that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function divisions(): BelongsToMany
    {
        return $this->belongsToMany(Division::class)->withPivot('isActive', 'post_id');
    }


    /**
     * The ward that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wards(): BelongsToMany
    {
        return $this->belongsToMany(Ward::class)->withPivot('isActive', 'post_id');
    }



    /**
     * The branches that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class )->withPivot('isActive', 'post_id');
    }


    /**
     * The posts that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class )->withPivot('isActive');
    }


    /**
     * The states that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function states(): BelongsToMany
    {
        return $this->belongsToMany(State::class )->withPivot('isActive', 'post_id');
    } 

    
}
