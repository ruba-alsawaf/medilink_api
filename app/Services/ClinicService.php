<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Clinic;

class ClinicService
{
    public function getAllClinics(array $filters = [], int $perPage = 50)
    {
        $query = Clinic::query()->with('partner')->withCount('doctors');

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['partner_id'])) {
            $query->where('partner_id', $filters['partner_id']);
        }

        return $query->paginate($perPage);
    }
}
