<?php

namespace App\Services;

use App\Exceptions\Errors;
use App\Models\Partner;
use App\Models\Entity;
use App\Policies\PartnerPolicy;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;

class PartnerService
{
    protected PartnerPolicy $partnerPolicy;

    public function __construct(PartnerPolicy $partnerPolicy)
    {
        $this->partnerPolicy = $partnerPolicy;
    }

    public function getPartners(int $perPage = 50, Entity $entity = null): LengthAwarePaginator
    {
        return Partner::withCount('clinics')
            ->with(['clinics' => function ($query) {
                $query->withCount('doctors');
            }])
            ->paginate($perPage);
    }

    public function getPartnerWithDetails(Partner $partner, Entity $entity = null)
    {
        if ($entity && !$this->partnerPolicy->view($entity, $partner)) {
            return null;
        }

        return $partner->load(['clinics' => function ($query) {
            $query->with('doctors')->withCount('doctors');
        }]);
    }
}
