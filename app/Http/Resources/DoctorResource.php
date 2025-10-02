<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'specialty' => $this->specialty,
            'status'    => $this->status,
            'clinic'    => [
                'id'   => $this->clinic?->id,
                'name' => $this->clinic?->name,
            ],
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
