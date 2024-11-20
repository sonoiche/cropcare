<?php

namespace Database\Seeders;

use App\Models\FarmMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FarmMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FarmMember::factory()->count(10)->create();
    }
}
