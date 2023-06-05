<?php

namespace App\Policies;

use App\Models\Subreddit;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubredditPolicy
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
     * @param  \App\Models\Subreddit  $subreddit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Subreddit $subreddit)
    {
        //
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
     * @param  \App\Models\Subreddit  $subreddit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Subreddit $subreddit)
    {
        return $user->id === $subreddit->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subreddit  $subreddit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Subreddit $subreddit)
    {
        return
            $user->id === $subreddit->user_id ||
            Subscribe::where('user_id', auth()->id())->where('subreddit_id', $subreddit->id)->value('role') == 'creator';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subreddit  $subreddit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Subreddit $subreddit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subreddit  $subreddit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Subreddit $subreddit)
    {
        //
    }
}
