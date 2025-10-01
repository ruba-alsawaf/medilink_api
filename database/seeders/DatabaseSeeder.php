<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Entity;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Entity::truncate();
        Doctor::truncate();
        Clinic::truncate();
        Partner::truncate();

        // 1. Partners (5,000)
        $partners = [];
        for ($i = 1; $i <= 5000; $i++) {
            $partners[] = [
                'name' => fake()->company(),
                'contact_email' => "partner{$i}@company.com",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        foreach (array_chunk($partners, 500) as $chunk) {
            Partner::insert($chunk);
        }

        $allPartners = Partner::all();

        // 2. Clinics (15,000)
        $clinics = [];
        $partnerIds = $allPartners->pluck('id')->toArray();
        
        for ($i = 1; $i <= 15000; $i++) {
            $clinics[] = [
                'partner_id' => fake()->randomElement($partnerIds),
                'name' => fake()->company() . ' Clinic',
                'city' => fake()->city(),
                'type' => fake()->randomElement(['hospital', 'lab', 'clinic']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        foreach (array_chunk($clinics, 500) as $chunk) {
            Clinic::insert($chunk);
        }

        $allClinics = Clinic::all();

        // 3. Doctors (30,000)
        $doctors = [];
        $clinicIds = $allClinics->pluck('id')->toArray();
        
        for ($i = 1; $i <= 30000; $i++) {
            $doctors[] = [
                'clinic_id' => fake()->randomElement($clinicIds),
                'name' => 'Dr. ' . fake()->name(),
                'specialty' => fake()->jobTitle(),
                'status' => fake()->randomElement(['active', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        foreach (array_chunk($doctors, 500) as $chunk) {
            Doctor::insert($chunk);
        }

        // 4. Entities 
        $this->createEntitiesInBatches();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function createEntitiesInBatches(): void
    {
        $entities = [];

        // Partner Admins (5,000)
        foreach (Partner::all() as $partner) {
            $entities[] = [
                'name' => "Partner Admin " . $partner->id,
                'email' => "partner_admin_{$partner->id}@medilink.com",
                'password' => bcrypt('password123'),
                'role' => 'partner_admin',
                'model_type' => 'Partner',
                'model_id' => $partner->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Clinic Admins (15,000)
        foreach (Clinic::all() as $clinic) {
            $entities[] = [
                'name' => "Clinic Admin " . $clinic->id,
                'email' => "clinic_admin_{$clinic->id}@medilink.com",
                'password' => bcrypt('password123'),
                'role' => 'clinic_admin',
                'model_type' => 'Clinic',
                'model_id' => $clinic->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($entities, 500) as $chunk) {
            Entity::insert($chunk);
        }
    }
}