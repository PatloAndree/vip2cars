<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'lastname' => 'vip2',
            'documento' => '85747485',
            'telefono' => '985748541',
            'email' => 'vip2cars@example.com',
            'password' => bcrypt('admin'), // o Hash::make()
        ]);
        
        // LLama al seeder de vehículos
        $this->call([
            VehicleSeeder::class,
        ]);

    }
}
