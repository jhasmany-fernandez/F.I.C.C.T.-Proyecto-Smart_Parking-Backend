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
            'monto' => 45.50,
            'reserva_id' => 1
        ]);

        // Pago::create([
        
        //     'monto' => 25.75,
        //     'reserva_id' => 2
        // ]);

        // Pago::create([
        
        //     'monto' => 55.20,
        //     'reserva_id' => 3
        // ]);

        // Pago::create([
           
        //     'monto' => 35.80,
        //     'reserva_id' => 4
        // ]);

        // Pago::create([
           
        //     'monto' => 65.00,
        //     'reserva_id' => 5
        // ]);

        // Pago::create([
          
        //     'monto' => 45.50,
        //     'reserva_id' => 6
        // ]);

        // Pago::create([
           
        //     'monto' => 25.75,
        //     'reserva_id' => 7
        // ]);

        // Pago::create([
         
        //     'monto' => 55.20,
        //     'reserva_id' => 8
        // ]);

        // Pago::create([
            
        //     'monto' => 35.80,
        //     'reserva_id' => 9
        // ]);

        // Pago::create([
           
        //     'monto' => 65.00,
        //     'reserva_id' => 10
        // ]);
    }
}
