<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;

class PartnerService
{
    public function getPartners(int $perPage = 50): LengthAwarePaginator
    {
        return Partner::with('clinics.doctors')  
            ->withCount('clinics')               
            ->withCount(['clinics as doctors_count' => function ($query) {
                $query->withCount('doctors');
            }])
            ->paginate($perPage);
    }

    public function getPartnerWithDetails(int $id)
    {
        return Partner::with(['clinics.doctors'])->findOrFail($id);
    }
}
