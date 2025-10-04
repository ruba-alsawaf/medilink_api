<?php

namespace App\Services;

use App\Models\Clinic;
use App\Models\Entity;
use App\Policies\ClinicPolicy;

class ClinicService
{
    public function getAllClinics(array $filters = [])
    {
        return Clinic::filters($filters)->with('partner')->withCount('doctors')->get();
    }
}
