<?php

namespace Database\Seeders;

use App\Models\Tarifa;
use Illuminate\Database\Seeder;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarifa::create([
            'tiempo' => '00:30:00',
            'monto' => '10',           
        ]);
        Tarifa::create([
            'tiempo' => '01:00:00',
            'monto' => '20',           
        ]);
        Tarifa::create([
            'tiempo' => '02:00:00',
            'monto' => '25',           
        ]);
        Tarifa::create([
            'tiempo' => '04:00:00',
            'monto' => '28',           
        ]);       
    }
}
