<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\GetClinicsRequest;
use App\Http\Resources\ClinicResource;
use App\Services\ClinicService;

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
            $clinics = $this->clinicService->getAllClinics($request->validated());
            return ClinicResource::collection($clinics);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }
}
