<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'deep', 'area', 'side', 'numberCount'];


    /**
     * The leaders that belong to the Leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leaders()
    {
        return $this->belongsToMany(Leader::class )->withPivot('isActive');
    }

    /**
     * The groups that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
