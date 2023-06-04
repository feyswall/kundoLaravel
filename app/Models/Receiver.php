<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receiver extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'phone'];

    public function mmses()
    {
        return $this->morphMany( Mms::class, 'mmsable' );
    }

}
