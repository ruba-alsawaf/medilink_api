<?php

namespace App\Services;

use App\Models\Clinic;

class ClinicService
{
    public function getClinics(array $filters)
    {
        $query = Clinic::query();

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['partner_id'])) {
            $query->where('partner_id', $filters['partner_id']);
        }

        return $query->paginate(20); 
    }
}
