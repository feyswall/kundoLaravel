<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'gender', 'phoneNumber', 'deleted_at'];

    public function tenable()
    {
        return $this->morphTo();
    }

    public function payments()
    {
        return $this->morphTo( Payment::class, 'payable' );
    }
}
