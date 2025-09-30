<?php

namespace Database\Seeders;
use App\Models\Univers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Univers::factory()
            ->count(5)
            ->create();
        //
    }
}
