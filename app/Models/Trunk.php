<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Trunk extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use BelongsToThrough;

    protected $fillable = ['name', 'branch_id'];


    public function region()
    {
        return $this->belongsToThrough( Region::class, [ District::class, Council::class, Division::class, Ward::class, Branch::class ]);
    }

    public function district()
    {
        return $this->belongsToThrough(District::class, [Council::class, Division::class, Ward::class, Branch::class ]);
    }

    public function council()
    {
        return $this->belongsToThrough(Council::class, [ Division::class, Ward::class, Branch::class ] );
    }

    public function division()
    {
        return $this->belongsToThrough( Division::class, [ Ward::class, Branch::class ] );
    }

    public function ward()
    {
        return $this->belongsToThrough(Ward::class, Branch::class );
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function leaders()
    {
        return $this->belongsToMany( Leader::class )
            ->withPivot('isActive', 'post_id')
            ->withTimestamps();
    }
}
