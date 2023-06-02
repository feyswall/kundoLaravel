<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mms extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'message', 'sms_amount', 'about'];

    public function mmsable()
    {
        return $this->morphTo();
    }

}
