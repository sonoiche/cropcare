<?php

namespace Database\Seeders;

use App\Models\Association;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Association::factory()->count(5)->create();
    }
}
