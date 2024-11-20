<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultation::factory()->count(10)->create();
    }
}
