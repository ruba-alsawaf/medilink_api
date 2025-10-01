<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPartnersRequest;
use App\Http\Resources\PartnerResource;
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
        $perPage = $request->validated()['per_page'] ?? 10;
        $partners = $this->service->getPartners($perPage);

        return PartnerResource::collection($partners);
    }
}
