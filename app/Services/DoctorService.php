<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Doctor;
use App\Models\Entity;
use App\Policies\DoctorPolicy;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorService
{
    protected DoctorPolicy $doctorPolicy;

    public function __construct(DoctorPolicy $doctorPolicy)
    {
        $this->doctorPolicy = $doctorPolicy;
    }

    public function getAllDoctors(array $filters = [])
    {
        return Doctor::filters($filters)->get();
    }

    public function createDoctor(array $data, Entity $entity): Doctor
    {
        if ($entity && !$this->doctorPolicy->canCreateInClinic($entity, $data['clinic_id'])) {
            throw new \Exception('You are not authorized to create doctors in this clinic');
        }

        return Doctor::create($data);
    }

    public function updateDoctorStatus(int $id, string $status, Entity $entity): Doctor
    {
        $doctor = Doctor::findOrFail($id);
        if ($entity && !$this->doctorPolicy->update($entity, $doctor)) {
            throw new \Exception('You are not authorized to update this doctor');
        }
        $doctor->update(['status' => $status]);
        return $doctor;
    }

}
