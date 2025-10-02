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
    public function viewAny(Entity $entity): bool
    {
        return in_array($entity->role, ['partner_admin', 'clinic_admin', 'doctor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Entity $entity, Partner $partner): bool
    {
        return match ($entity->role) {
            'partner_admin' => $partner->id === $entity->model_id,
            'clinic_admin'  => $this->getClinicPartnerId($entity) === $partner->id,
            'doctor'        => $this->getDoctorPartnerId($entity) === $partner->id,
            default         => false,
        };
    }

    /**
     * Get partners that the user can access
     */
    public function getAccessiblePartnersQuery(Entity $entity)
    {
        return match ($entity->role) {
            'partner_admin' => Partner::where('id', $entity->model_id),
            'clinic_admin'  => Partner::where('id', $this->getClinicPartnerId($entity)),
            'doctor'        => Partner::where('id', $this->getDoctorPartnerId($entity)),
            default         => Partner::where('id', 0),
        };
    }

    /**
     * Helper method to get clinic's partner ID
     */
    private function getClinicPartnerId(Entity $entity): ?int
    {
        if ($entity->role === 'clinic_admin' && $entity->model_type === 'Clinic') {
            $clinic = $entity->model;
            return $clinic->partner_id ?? null;
        }
        return null;
    }

    /**
     * Helper method to get doctor's partner ID
     */
    private function getDoctorPartnerId(Entity $entity): ?int
    {
        if ($entity->role === 'doctor' && $entity->model_type === 'Doctor') {
            $doctor = $entity->model;
            return $doctor->clinic->partner_id ?? null;
        }
        return null;
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
