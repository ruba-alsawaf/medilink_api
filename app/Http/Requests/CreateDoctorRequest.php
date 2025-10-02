<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'clinic_id' => 'required|exists:clinics,id',
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|email|unique:entities,email',
            'phone'     => 'nullable|string|max:20',
            'specialty' => 'required|string|max:255',
            'status'    => 'required|in:active,inactive',
        ];
    }
}
