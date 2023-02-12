<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;

    protected  $fillable = ['url', 'type', 'user_id', 'challenge_id'];

    /**
     * @return BelongsTo
     */
    public function challenge():BelongsTo
    {
        return $this->belongsTo( Challenge::class );
    }


    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo( User::class );
    }
}
