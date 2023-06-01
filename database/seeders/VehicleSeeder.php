<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'placa' => 'ABC123',
            'marca' => 'Toyota',
            'color' => 'Rojo',
            'tipo' => 'Sedán',
            'user_id' => 1,
        ]);

        Vehicle::create([
            'placa' => 'DEF456',
            'marca' => 'Honda',
            'color' => 'Azul',
            'tipo' => 'SUV',
            'user_id' => 2,
        ]);

        Vehicle::create([
            'placa' => 'GHI789',
            'marca' => 'Ford',
            'color' => 'Negro',
            'tipo' => 'Camioneta',
            'user_id' => 3,
        ]);

        Vehicle::create([
            'placa' => 'JKL012',
            'marca' => 'Chevrolet',
            'color' => 'Blanco',
            'tipo' => 'Hatchback',
            'user_id' => 1,
        ]);

        Vehicle::create([
            'placa' => 'MNO345',
            'marca' => 'Volkswagen',
            'color' => 'Gris',
            'tipo' => 'SUV',
            'user_id' => 4,
        ]);

        Vehicle::create([
            'placa' => 'PQR678',
            'marca' => 'BMW',
            'color' => 'Plateado',
            'tipo' => 'Coupé',
            'user_id' => 5,
        ]);

        Vehicle::create([
            'placa' => 'STU901',
            'marca' => 'Nissan',
            'color' => 'Verde',
            'tipo' => 'Sedán',
            'user_id' => 2,
        ]);

        Vehicle::create([
            'placa' => 'VWX234',
            'marca' => 'Mercedes-Benz',
            'color' => 'Negro',
            'tipo' => 'SUV',
            'user_id' => 3,
        ]);

        Vehicle::create([
            'placa' => 'YZA567',
            'marca' => 'Audi',
            'color' => 'Rojo',
            'tipo' => 'Coupé',
            'user_id' => 4,
        ]);

        Vehicle::create([
            'placa' => 'BCD890',
            'marca' => 'Kia',
            'color' => 'Azul',
            'tipo' => 'Sedán',
            'user_id' => 5,
        ]);
    }
}
