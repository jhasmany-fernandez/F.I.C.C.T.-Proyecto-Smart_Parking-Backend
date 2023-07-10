<?php

namespace Database\Seeders;

use App\Models\Espacio;
use Illuminate\Database\Seeder;

class EspacioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Espacio::create([
            'numero' => '1',
            'estado' => false,
        ]);
        Espacio::create([
            'numero' => '2',
            'estado' => false,
        ]);
        Espacio::create([
            'numero' => '3',
            'estado' => false,
        ]);
    }
}
