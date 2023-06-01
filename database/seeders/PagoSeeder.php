<?php

namespace Database\Seeders;

use App\Models\Pago;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pago::create([
            'tiempo_reserva' => 4,
            'monto' => 45.50,
            'reserva_id' => 1
        ]);

        Pago::create([
            'tiempo_reserva' => 2,
            'monto' => 25.75,
            'reserva_id' => 2
        ]);

        Pago::create([
            'tiempo_reserva' => 5,
            'monto' => 55.20,
            'reserva_id' => 3
        ]);

        Pago::create([
            'tiempo_reserva' => 3,
            'monto' => 35.80,
            'reserva_id' => 4
        ]);

        Pago::create([
            'tiempo_reserva' => 6,
            'monto' => 65.00,
            'reserva_id' => 5
        ]);

        Pago::create([
            'tiempo_reserva' => 4,
            'monto' => 45.50,
            'reserva_id' => 6
        ]);

        Pago::create([
            'tiempo_reserva' => 2,
            'monto' => 25.75,
            'reserva_id' => 7
        ]);

        Pago::create([
            'tiempo_reserva' => 5,
            'monto' => 55.20,
            'reserva_id' => 8
        ]);

        Pago::create([
            'tiempo_reserva' => 3,
            'monto' => 35.80,
            'reserva_id' => 9
        ]);

        Pago::create([
            'tiempo_reserva' => 6,
            'monto' => 65.00,
            'reserva_id' => 10
        ]);
    }
}
