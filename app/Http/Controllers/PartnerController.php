<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\GetPartnerRequest;
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
        try {
            $perPage = $request->validated()['per_page'] ?? 50;
            $partners = $this->service->getPartners($perPage);

            return PartnerResource::collection($partners);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }

    public function show(GetPartnerRequest $request, $id)
    {
        try {
            $partner = $this->service->getPartnerWithDetails($id);
            return new PartnerResource($partner);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }
}
