<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Clinic;
use App\Models\Entity;
use App\Policies\ClinicPolicy;

class ClinicService
{
    protected ClinicPolicy $clinicPolicy;

    public function __construct(ClinicPolicy $clinicPolicy)
    {
        $this->clinicPolicy = $clinicPolicy;
    }

    public function getAllClinics(array $filters = [], int $perPage = 50, Entity $entity)
    {
        if ($entity) {
            $query = $this->clinicPolicy->getAccessibleClinicsQuery($entity);
        } else {
            $query = Clinic::query();
        }

        $query->with('partner')->withCount('doctors');

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['partner_id'])) {
            $query->where('partner_id', $filters['partner_id']);
        }

        return $query->paginate($perPage);
    }
}
