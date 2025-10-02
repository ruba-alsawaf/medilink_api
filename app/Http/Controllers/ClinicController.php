<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
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

    public function index(Request $request)
    {
        try {
            $clinics = $this->clinicService->getAllClinics($request->only(['city', 'partner_id']));
            return ClinicResource::collection($clinics);
        } catch (\Exception $e) {
            Errors::InternalServerError($e->getMessage());
        }
    }
}
