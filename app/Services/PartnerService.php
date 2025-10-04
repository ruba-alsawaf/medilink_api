<?php

namespace App\Services;

use App\Models\Partner;
use App\Policies\PartnerPolicy;

class PartnerService
{
    protected PartnerPolicy $partnerPolicy;

    public function __construct(PartnerPolicy $partnerPolicy)
    {
        $this->partnerPolicy = $partnerPolicy;
    }

    public function getPartners(int $perPage)
    {
        return Partner::withCount('clinics')->withCount(['clinics as doctors_count' => function ($query) {
            $query->join('doctors', 'clinics.id', '=', 'doctors.clinic_id');
        }])->paginate($perPage);
    }

    public function getPartnerWithDetails(Partner $partner)
    {
        return $partner->load(['clinics' => function ($query) {
            $query->with('doctors')->withCount('doctors');
        }]);
    }
}
