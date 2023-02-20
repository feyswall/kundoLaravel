<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sial extends Model
{
    use HasFactory;

    protected $fillable = ['letter_url', 'note', 'title'];

    public function leaders()
    {
        return $this->belongsToMany(Leader::class)->withPivot(
            'titled'
        )->withTimestamps();
    }
}
