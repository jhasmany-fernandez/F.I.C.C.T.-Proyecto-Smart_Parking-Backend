<?php

namespace Database\Seeders;

use App\Models\Reporte;
use Illuminate\Database\Seeder;

class ReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reporte::create([
            'motivo' => 'Colisión en la intersección',
            'fecha_hora' => '2023-05-20 09:15:00',
            'vehicle_id' => 1
        ]);

        Reporte::create([
            'motivo' => 'Daños por granizo en el estacionamiento',
            'fecha_hora' => '2023-05-21 14:30:00',
            'vehicle_id' => 2
        ]);

        Reporte::create([
            'motivo' => 'Accidente de motocicleta en la autopista',
            'fecha_hora' => '2023-05-22 16:45:00',
            'vehicle_id' => 3
        ]);

        Reporte::create([
            'motivo' => 'Choque en la parte trasera en un semáforo',
            'fecha_hora' => '2023-05-22 18:20:00',
            'vehicle_id' => 4
        ]);

        Reporte::create([
            'motivo' => 'Daños en la carrocería por vandalismo',
            'fecha_hora' => '2023-05-23 11:10:00',
            'vehicle_id' => 5
        ]);

        Reporte::create([
            'motivo' => 'Incidente de estacionamiento en doble fila',
            'fecha_hora' => '2023-05-24 13:45:00',
            'vehicle_id' => 6
        ]);

        Reporte::create([
            'motivo' => 'Golpe en la puerta del conductor en el supermercado',
            'fecha_hora' => '2023-05-25 09:55:00',
            'vehicle_id' => 7
        ]);

        Reporte::create([
            'motivo' => 'Colisión lateral en una rotonda',
            'fecha_hora' => '2023-05-26 17:30:00',
            'vehicle_id' => 8
        ]);

        Reporte::create([
            'motivo' => 'Daños por inundación en la calle',
            'fecha_hora' => '2023-05-27 12:40:00',
            'vehicle_id' => 9
        ]);

        Reporte::create([
            'motivo' => 'Incidente de aparcamiento en el centro comercial',
            'fecha_hora' => '2023-05-28 15:20:00',
            'vehicle_id' => 10
        ]);
    }
}
