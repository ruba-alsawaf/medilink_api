<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\GetDoctorsRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Services\DoctorService;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index(GetDoctorsRequest $request)
    {
        $doctors = $this->doctorService->getAllDoctors($request->validated());
        return DoctorResource::collection($doctors);
    }

    public function store(CreateDoctorRequest $request): JsonResponse
    {
        $doctor = $this->doctorService->createDoctor($request->validated());
        return response()->json([
            'status' => 'success',
            'data' => new DoctorResource($doctor),
        ], 201);
    }

    public function update(UpdateDoctorRequest $request, int $id): JsonResponse
    {
        $doctor = $this->doctorService->updateDoctorStatus($id, $request->status);
        return response()->json([
            'status' => 'success',
            'data' => new DoctorResource($doctor),
        ], 200);
    }
}
