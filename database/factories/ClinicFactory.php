<?php

namespace Database\Factories;

use App\Constants\Constant;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Clinic::class;

    public function definition(): array
    {
        return [
            'partner_id' => 1,
            'name' => $this->faker->company . ' Clinic',
            'city' => $this->faker->city,
            'type' => $this->faker->randomElement(Constant::CLINIC_TYPES),
        ];
    }
}
