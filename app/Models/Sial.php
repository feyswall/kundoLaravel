<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sial extends Model
{
    use HasFactory;

    protected $fillable = ['letter_url', 'note', 'title', 'area_name', 'area_id'];

    public function leaders()
    {
        return $this->belongsToMany(Leader::class)->withPivot(
            'titled', 'receiver_post_id', 'seen'
        )->withTimestamps();
    }

    public function inToMany(User $user)
    {
        $leader = $this->leaders()->where('leader_id', $user->leader->id)->first();
        return $leader;
    }
}
