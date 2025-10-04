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

    public function getAllDoctors(array $filters = [], int $perPage = 50, Entity $entity = null): LengthAwarePaginator
    {
        if ($entity) {
            $query = $this->doctorPolicy->getAccessibleDoctorsQuery($entity);
        } else {
            $query = Doctor::query();
        }

        $query->with('clinic')->withCount('entities');

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['specialty'])) {
            $query->where('specialty', 'like', '%' . $filters['specialty'] . '%');
        }

        return $query->paginate($perPage);
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

    public function getDoctorById(int $id, Entity $entity = null): ?Doctor
    {
        $doctor = Doctor::with('clinic')->find($id);

        if (!$doctor) {
            return null;
        }

        if ($entity && !$this->doctorPolicy->view($entity, $doctor)) {
            return null;
        }

        return $doctor;
    }
}