<?php

namespace App\Services;

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

    public function getAllClinics(array $filters = [])
    {
        try {
            return Clinic::filters($filters)->with('partner')->withCount('doctors')->get();
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
