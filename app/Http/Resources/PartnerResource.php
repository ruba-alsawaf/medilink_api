<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact_email' => $this->contact_email,
            'clinic_count' => $this->whenNotNull($this->clinics_count),
            'doctor_count' => $this->whenNotNull($this->doctors_count),
            'clinics' => ClinicResource::collection($this->whenLoaded('clinics')),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
