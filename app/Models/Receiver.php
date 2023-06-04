<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    public function mmses()
    {
        return $this->morphMany( Mms::class, 'mmsable' );
    }

}