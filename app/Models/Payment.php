<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['perMonth_payment','received_payment','start_month', 'month_count', 'end_month'];

    public function payable()
    {
        return $this->morphTo();
    }

    public function tenant()
    {
        return $this->belongsTo(  Tenant::class )->withTrashed();
    }

    public function sendable()
    {
        return $this->morphTo();
    }

}
