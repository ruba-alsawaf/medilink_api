<?php

namespace App\Policies;

use App\Models\Entity;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Entity $user): bool
    {
        return in_array($user->role, ['super_admin', 'partner_admin']);
    }

    /**
     * Determine whether the user can view the model.
     */

    public function view(Entity $user, Partner $partner): bool
    {
        if ($user->role === 'super_admin') return true;
        if ($user->role === 'partner_admin' && $user->model_id === $partner->id) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Entity $user, Partner $partner): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partner $partner): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Partner $partner): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Partner $partner): bool
    {
        return false;
    }
}
