<?php

namespace Database\Seeders;

use App\Models\Geographic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Geographic::factory()->count(50)->create();
    }
}
