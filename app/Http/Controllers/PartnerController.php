<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\GetPartnersRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;

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
            $entity = Auth::user();
            
            $partners = $this->service->getPartners($perPage, $entity);

            return PartnerResource::collection($partners);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }

    public function show(Partner $partner)
{
    $this->authorize('view', $partner);

    try {
        $entity = Auth::user();
        Log::info('Fetching partner details', [
            'partner_id' => $partner->id,
            'entity_id' => $entity->id,
            'entity_role' => $entity->role
        ]);
        
        $partnerWithDetails = $this->service->getPartnerWithDetails($partner, $entity);

        if (!$partnerWithDetails) {
            return Errors::ResourceNotFound('Partner not found or access denied');
        }

        Log::info('Partner details fetched successfully');
        return new PartnerResource($partnerWithDetails);
        
    } catch (\Exception $e) {
        Log::error('Error in partner show method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        return Errors::InternalServerError($e->getMessage());
    }
}
}