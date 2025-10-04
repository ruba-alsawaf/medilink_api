<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Entity $entity): bool
    {
        return in_array($entity->role, ['partner_admin', 'clinic_admin', 'doctor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Entity $entity, Doctor $doctor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Entity $entity): bool
    {
        return $entity->role === 'clinic_admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Entity $entity, Doctor $doctor): bool
    {
        return $entity->role === 'clinic_admin' && $doctor->clinic_id === $entity->model_id;
    }

    /**
     * Check if user can create doctor in specific clinic
     */
    public function canCreateInClinic(Entity $entity, int $clinicId): bool
    {
        return $entity->role === 'clinic_admin' && $clinicId === $entity->model_id;
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Doctor $doctor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Doctor $doctor): bool
    {
        return false;
    }
}
