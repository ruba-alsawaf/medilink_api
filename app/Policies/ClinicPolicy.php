<?php

namespace App\Policies;

use App\Models\Clinic;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClinicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Entity $entity): bool
    {
        return in_array($entity->role, ['partner_admin', 'clinic_admin', 'doctor']);
    }

    /**
     * Determine whether the user can view a specific clinic.
     */
    public function view(Entity $entity, Clinic $clinic): bool
    {
        return match ($entity->role) {
            'partner_admin' => $clinic->partner_id === $entity->model_id,
            'clinic_admin'  => $clinic->id === $entity->model_id,
            'doctor'        => $clinic->id === $entity->model->clinic_id ?? null,
            default         => false,
        };
    }
    public function getAccessibleClinicsQuery(Entity $entity)
    {
        return match ($entity->role) {
            'partner_admin' => Clinic::where('partner_id', $entity->model_id),
            'clinic_admin'  => Clinic::where('id', $entity->model_id),
            'doctor'        => Clinic::where('id', $entity->model->clinic_id ?? null),
            default         => Clinic::where('id', 0),
        };
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
    public function update(User $user, Clinic $clinic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clinic $clinic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clinic $clinic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clinic $clinic): bool
    {
        return false;
    }
}
