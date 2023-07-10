<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Diego Hurtado Vargas',
            'email' => 'Diego@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'José Fernando Chile Laime',
            'email' => 'Jose@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Joan Paul Cruz Vargas',
            'email' => 'Paul@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Melanie Daisy Yupanqui Larico',
            'email' => 'Melanie@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Natalia Quiroga Gutiérrez',
            'email' => 'Natalia@gmail.com',
          
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Jhasmany Ortega',
            'email' => 'Jhasmany@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Yordi Condori Escalera',
            'email' => 'Yordi@gmail.com',
            'ci'=>'12345678',
            'password' => bcrypt('12345678'),
        ]);
    }
}
