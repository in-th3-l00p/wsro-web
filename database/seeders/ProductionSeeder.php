<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Tisca Catalin',
            'email' => 'admin@tiscacatalin.com',
            'role' => 'admin'
        ]);
    }
}
