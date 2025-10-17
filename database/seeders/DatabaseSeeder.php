<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Entity;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $partners = Partner::factory()->count(50)->create();
        $clinics = Clinic::factory()->count(150)
            ->sequence(fn($sequence) => ['partner_id' => $partners->random()->id])
            ->create();

        Doctor::factory()->count(300)
            ->sequence(fn($sequence) => ['clinic_id' => $clinics->random()->id])
            ->create();

        $partners->each(function ($partner) {
            Entity::factory()
                ->state([
                    'name' => "Partner Admin " . $partner->id,
                    'email' => "partner_admin_{$partner->id}@medilink.com",
                    'role' => 'partner_admin',
                    'model_type' => Partner::class,
                    'model_id' => $partner->id,
                ])
                ->create();
        });

        $clinics->each(function ($clinic) {
            Entity::factory()
                ->state([
                    'name' => "Clinic Admin " . $clinic->id,
                    'email' => "clinic_admin_{$clinic->id}@medilink.com",
                    'role' => 'clinic_admin',
                    'model_type' => Clinic::class,
                    'model_id' => $clinic->id,
                ])
                ->create();
        });
    }
}
