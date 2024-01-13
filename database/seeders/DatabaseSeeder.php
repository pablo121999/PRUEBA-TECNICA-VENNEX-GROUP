<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\tipocredito;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@email.com';
        $user->password = '123456';
        $user->rol = 'admin';
        $user->save();

        $tipocredito = new tipocredito;
        $tipocredito->nombrecredito = 'Libre inversión';
        $tipocredito->interes = 2.5;
        $tipocredito->save();

        // Crea una nueva instancia para el siguiente tipo de crédito
        $tipocredito = new tipocredito;
        $tipocredito->nombrecredito = 'Vivienda';
        $tipocredito->interes = 1.3;
        $tipocredito->save();


    }
}
