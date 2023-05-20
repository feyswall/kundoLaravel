<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharityCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function charities()
    {
        return $this->hasMany(Charity::class );
    }
}
