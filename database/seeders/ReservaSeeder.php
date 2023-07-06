<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reserva::create([
            'fecha_hora_ingreso_reserva' => '2023-06-01 09:00:00',
            'fecha_hora_salida_reserva' => '2023-06-01 18:00:00',            
            'fecha_hora_salida' => '2023-06-01 18:00:00',
            'estado' => 1,
            'qrentrada' => 'null',
            'qrsalida' => 'null',            
            'espacio_id' => 1,
            'tarifa_id' => 1,
            'vehicle_id' => 1,

        ]);

        Reserva::create([            
            'fecha_hora_ingreso_reserva' => '2023-06-02 10:30:00',
            'fecha_hora_salida_reserva' => '2023-06-02 17:30:00',            
            'fecha_hora_salida' => '2023-06-02 17:30:00',
            'estado' => 2,
            'qrentrada' => 'null',
            'qrsalida' => 'null',            
            'espacio_id' => 2,
            'tarifa_id' => 1,           
            'vehicle_id' => 2
        ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-03 12:15:00',
        //     'fecha_hora_salida' => '2023-06-03 15:45:00',
        //     'lugar_reserva' => 30,
        //     'vehicle_id' => 3
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-04 14:45:00',
        //     'fecha_hora_salida' => '2023-06-04 19:30:00',
        //     'lugar_reserva' => 40,
        //     'vehicle_id' => 4
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-05 11:30:00',
        //     'fecha_hora_salida' => '2023-06-05 16:00:00',
        //     'lugar_reserva' => 50,
        //     'vehicle_id' => 5
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-06 13:20:00',
        //     'fecha_hora_salida' => '2023-06-06 18:45:00',
        //     'lugar_reserva' => 60,
        //     'vehicle_id' => 6
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-07 10:00:00',
        //     'fecha_hora_salida' => '2023-06-07 14:30:00',
        //     'lugar_reserva' => 70,
        //     'vehicle_id' => 7
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-08 15:45:00',
        //     'fecha_hora_salida' => '2023-06-08 20:15:00',
        //     'lugar_reserva' => 80,
        //     'vehicle_id' => 8
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-09 12:30:00',
        //     'fecha_hora_salida' => '2023-06-09 17:30:00',
        //     'lugar_reserva' => 90,
        //     'vehicle_id' => 9
        // ]);

        // Reserva::create([
        //     'fecha_hora_ingreso' => '2023-06-10 11:00:00',
        //     'fecha_hora_salida' => '2023-06-10 16:00:00',
        //     'lugar_reserva' => 100,
        //     'vehicle_id' => 10
        // ]);
    }
}
