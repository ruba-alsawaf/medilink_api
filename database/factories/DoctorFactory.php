<?php

namespace Database\Factories;

use App\Constants\Constant;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'clinic_id' => 1,
            'name' => $this->faker->name,
            'specialty' => $this->faker->jobTitle,
            'status' => $this->faker->randomElement(Constant::DOCTOR_STATUSES),
        ];
    }
}
