<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;

class PartnerService
{
    public function getPartners(int $perPage = 10): LengthAwarePaginator
    {
        try {
            return Partner::with('clinics.doctors')->paginate($perPage);
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }

    public function getPartnerWithDetails(int $id)
    {
        try {
            return Partner::with('clinics.doctors')->findOrFail($id);
        } catch (\Throwable $e) {
            throw Errors::InternalServerError($e->getMessage());
        }
    }
}
