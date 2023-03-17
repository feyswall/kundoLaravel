<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDoor extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'name', 'copy', 'address', 'url'];
}
