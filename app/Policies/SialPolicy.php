<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Sial;
use App\Models\User;

class SialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Sial $sial)
    {
        $copyTo = Sial::select("*")->whereHas('leaders', function ($query) use ($user) {
            $query->where('leader_id', $user->leader->id);
        })->exists();
        $returnVal = $user->leader->id == $sial->receiver_id || $copyTo || $user->hasRole('super');
        return $returnVal;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Sial $sial)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sial $sial)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Sial $sial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Sial $sial)
    {
        //
    }
}
