<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Doctor;

class DoctorService
{
    public function getAllDoctors(array $filters = [], int $perPage = 50)
    {
        $query = Doctor::filters($filters)->with('clinic')->withCount('entities');

        return $query->paginate($perPage);
    }

    public function createDoctor(array $data): Doctor
    {
        return Doctor::create($data);
    }

    public function updateDoctorStatus(int $id, string $status): Doctor
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['status' => $status]);
        return $doctor;
    }
}
