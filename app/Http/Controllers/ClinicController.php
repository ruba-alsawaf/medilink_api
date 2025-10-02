<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetClinicsRequest;
use Illuminate\Http\Request;
use App\Services\ClinicService;
use App\Http\Resources\ClinicResource;

class ClinicController extends Controller
{
    protected $clinicService;

    public function __construct(ClinicService $clinicService)
    {
        $this->clinicService = $clinicService;
    }

    public function index(GetClinicsRequest $request)
    {
        $clinics = $this->clinicService->getClinics($request->validated());
        return ClinicResource::collection($clinics);
    }
}
