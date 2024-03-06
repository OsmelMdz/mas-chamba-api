<?php

namespace App\Policies;

use App\Models\PrestadordeServicio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrestadordeServicioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrestadordeServicio $prestadordeServicio): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrestadordeServicio $prestadordeServicio): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrestadordeServicio $prestadordeServicio): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrestadordeServicio $prestadordeServicio): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrestadordeServicio $prestadordeServicio): bool
    {
        //
    }
}
