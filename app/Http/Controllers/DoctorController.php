<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
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

        try {
            $filters = $request->all();
            $data = $this->doctorService
                ->getAllDoctors($filters);
            return $this->success($data, 'data', 200);
        } catch (ApiException $e) {
            throw $e;
        }
    }

    public function store(CreateDoctorRequest $request): JsonResponse
    {
        $this->authorize('create', Doctor::class);

        $entity = Auth::user();
        try {
            $doctor = $this->doctorService->createDoctor($request->validated(), $entity);
            return $this->success($doctor, 'data', 201);
        } catch (ApiException $e) {
            throw $e;
        }
    }

    public function update(UpdateDoctorRequest $request, int $id): JsonResponse
    {
        try {
            $entity = Auth::user();
            $doctor = $this->doctorService->updateDoctorStatus($id, $request->status, $entity);

            return $this->success($doctor, 'data', 200);
        } catch (ApiException $e) {
            throw $e;
        }
    }
}
