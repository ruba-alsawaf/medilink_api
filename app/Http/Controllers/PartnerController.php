<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\GetPartnersRequest;
use App\Models\Partner;
use App\Services\PartnerService;

class PartnerController extends Controller
{
    protected PartnerService $service;

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
    }

    public function index(GetPartnersRequest $request)
    {
        $this->authorize('viewAny', Partner::class);

        try {
            $perPage = $request->get('per_page', 50);
            $partners = $this->service->getPartners($perPage);

            return $this->success($partners, 'data', 200);
        } catch (ApiException $e) {
            throw $e;
        }
    }

    public function show(Partner $partner)
    {
        $this->authorize('view', $partner);

        try {
            $partnerWithDetails = $this->service->getPartnerWithDetails($partner);
            return $this->success($partnerWithDetails, 'data', 200);
        } catch (ApiException $e) {
            throw $e;
        }
    }
}
