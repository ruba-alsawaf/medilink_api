<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
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
            $filters = $request->all();
            $data = $this->clinicService
                ->getAllClinics($filters);
            return $this->success($data, 'data', 200);
        } catch (ApiException $e) {
            throw $e;
        }
    }
}
