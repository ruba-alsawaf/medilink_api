<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\GetClinicsRequest;
use App\Http\Resources\ClinicResource;
use App\Services\ClinicService;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    protected $clinicService;

    public function __construct(ClinicService $clinicService)
    {
        $this->clinicService = $clinicService;
    }

    public function index(GetClinicsRequest $request)
    {
        try {
            $perPage = $request->get('per_page', 50);
            $entity = Auth::user();

            $clinics = $this->clinicService->getAllClinics(
                $request->only(['city', 'partner_id']),
                $perPage,
                $entity
            );

            return ClinicResource::collection($clinics);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }
}
