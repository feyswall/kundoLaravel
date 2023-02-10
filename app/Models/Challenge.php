<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['status', 'challenge', 'from'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public  function state():BelongsTo {
        return $this->belongsTo(State::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function  leader():BelongsTo
    {
        return $this->belongsTo(Leader::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets():HasMany
    {
        return $this->hasMany(Asset::class );
    }
}
