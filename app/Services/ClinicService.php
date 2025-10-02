<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Clinic;

class ClinicService
{
    public function getAllClinics(array $filters = [], bool $isPaginated = true, int $perPage = 10)
    {
        try {
            $query = Clinic::query();

            if (!empty($filters['city'])) {
                $query->where('city', $filters['city']);
            }

            if (!empty($filters['partner_id'])) {
                $query->where('partner_id', $filters['partner_id']);
            }

            $query->with('partner');

            return $isPaginated ? $query->paginate($perPage) : $query->get();
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }
}
