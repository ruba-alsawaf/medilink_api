<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Doctor;

class DoctorService
{
    public function getAllDoctors(array $filters = [], array $relations = [], bool $isPaginated = true, int $perPage = 10)
    {
        try {
            $query = Doctor::filters($filters)->with($relations);

            return $isPaginated ? $query->paginate($perPage) : $query->get();
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }

    public function createDoctor(array $data): Doctor
    {
        try {
            $doctor = Doctor::create($data);
            return Doctor::findOrFail($doctor->id)->load('clinic');
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }

    public function updateDoctorStatus(int $id, string $status): Doctor
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update(['status' => $status]);
            return $doctor->load('clinic');
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }
}
