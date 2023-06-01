<?php

namespace Database\Seeders;

use App\Models\Bitacora;
use Illuminate\Database\Seeder;

class BitacoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-01 09:30:00',
            'fecha_hora_salida' => '2023-06-01 15:45:00',
            'vehicle_id' => 1
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-02 11:15:00',
            'fecha_hora_salida' => '2023-06-02 16:20:00',
            'vehicle_id' => 2
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-03 08:45:00',
            'fecha_hora_salida' => '2023-06-03 13:10:00',
            'vehicle_id' => 3
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-04 10:00:00',
            'fecha_hora_salida' => '2023-06-04 17:30:00',
            'vehicle_id' => 4
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-05 09:20:00',
            'fecha_hora_salida' => '2023-06-05 14:15:00',
            'vehicle_id' => 5
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-06 12:00:00',
            'fecha_hora_salida' => '2023-06-06 17:45:00',
            'vehicle_id' => 6
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-07 08:30:00',
            'fecha_hora_salida' => '2023-06-07 14:20:00',
            'vehicle_id' => 7
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-08 10:45:00',
            'fecha_hora_salida' => '2023-06-08 16:30:00',
            'vehicle_id' => 8
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-09 09:15:00',
            'fecha_hora_salida' => '2023-06-09 15:40:00',
            'vehicle_id' => 9
        ]);

        Bitacora::create([
            'fecha_hora_ingreso' => '2023-06-10 11:30:00',
            'fecha_hora_salida' => '2023-06-10 18:15:00',
            'vehicle_id' => 10
        ]);
    }
}
