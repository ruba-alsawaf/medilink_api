<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\GetDoctorsRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DoctorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index(GetDoctorsRequest $request)
    {
        $this->authorize('viewAny', Doctor::class);

        try {
            $perPage = $request->get('per_page', 50);
            $entity = Auth::user();

            $doctors = $this->doctorService->getAllDoctors($request->validated(), $perPage, $entity);

            return DoctorResource::collection($doctors);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }

    public function store(CreateDoctorRequest $request): JsonResponse
    {
        $this->authorize('create', Doctor::class);

        try {
            $entity = Auth::user();
            $doctor = $this->doctorService->createDoctor($request->validated(), $entity);

            return response()->json([
                'status' => 'success',
                'data' => new DoctorResource($doctor),
            ], 201);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }

    public function update(UpdateDoctorRequest $request, int $id): JsonResponse
    {
        try {
            $entity = Auth::user();
            $doctor = $this->doctorService->updateDoctorStatus($id, $request->status, $entity);

            return response()->json([
                'status' => 'success',
                'data' => new DoctorResource($doctor),
            ], 200);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            $entity = Auth::user();
            $doctor = $this->doctorService->getDoctorById($id, $entity);

            if (!$doctor) {
                return Errors::ResourceNotFound('Doctor not found or access denied');
            }

            return new DoctorResource($doctor);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }
}
