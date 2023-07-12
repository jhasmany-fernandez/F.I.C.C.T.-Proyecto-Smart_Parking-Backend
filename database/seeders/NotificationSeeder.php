<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'user_id' => 1,
            'titulo'=>'alerta mal estacionada',
            'description' => 'Estacione bien su vehículo, de lo contrario se descontará una multa a su cuenta.',
        ]);

        Notification::create([
            'user_id' => 2,
            'titulo'=>'Poco tiempo',
            'description' => 'Quedan 5 minutos de plazo para que concluya su tiempo de parqueo.',
        ]);
    }
}
