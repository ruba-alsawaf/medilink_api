<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use App\Http\Requests\GetDoctorsRequest;
use App\Http\Resources\DoctorResource;
use App\Services\DoctorService;
use Illuminate\Http\Request;

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
            $validated = $request->validated();

            $filters     = collect($validated)->except(['relations', 'paginated', 'per_page'])->toArray();
            $relations   = $validated['relations'] ?? [];
            $isPaginated = $validated['paginated'] ?? true;
            $perPage     = $validated['per_page'] ?? 10;

            $doctors = $this->doctorService->getAllDoctors(
                $filters,
                $relations,
                $isPaginated,
                $perPage
            );

            return DoctorResource::collection($doctors);
        } catch (\Exception $e) {
            return Errors::InternalServerError($e->getMessage());
        }
    }
}
