<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'cost', 'charity_categories_id', 'inDate'];

    public function charity_category()
    {
        return $this->belongsTo( CharityCategory::class, 'charity_categories_id' );
    }
}
