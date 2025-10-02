<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Models\Doctor;

class DoctorService
{
    public function getAllDoctors(
        array $filters = [],
        array $relations = [],
        bool $isPaginated = true,
        int $perPage = 10
    ) {
        try {
            $query = Doctor::filters($filters)->with($relations);

            return $isPaginated
                ? $query->paginate($perPage)
                : $query->get();
        } catch (\Throwable $e) {
            throw new ApiException(
                $e->getMessage(),
                'INTERNAL_SERVER_ERROR',
                500,
                $e->getTraceAsString()
            );
        }
    }
}
