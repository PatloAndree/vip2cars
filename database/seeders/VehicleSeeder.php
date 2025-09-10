<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Vehicle::create([
            'user_id'          => 1,
            'placa'            => 'ABC-123',
            'marca'            => 'Toyota',
            'modelo'           => 'Corolla',
            'añofabricacion'   => '2015-05-10',
            'telefono'         => 987654321,
            'status'           => 1,
        ]);
    }
}
