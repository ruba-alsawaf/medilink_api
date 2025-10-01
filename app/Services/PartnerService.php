<?php

namespace App\Services;

use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;

class PartnerService
{
    public function getPartners(int $perPage = 10): LengthAwarePaginator
    {
        return Partner::with('clinics.doctors')
            ->paginate($perPage);
    }
}
