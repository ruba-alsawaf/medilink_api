<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
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
            'city' => $this->city,
            'type' => $this->type,
            'partner_id' => $this->partner_id,
            'partner' => new PartnerResource($this->whenLoaded('partner')),
            'doctor_count' => $this->whenNotNull($this->doctors_count),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

        ];
    }
}
