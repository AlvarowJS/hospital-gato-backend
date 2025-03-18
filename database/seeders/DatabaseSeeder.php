<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Condicion;
use App\Models\User;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Sede;
use App\Models\Gerente;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Provincia::factory(4)->create();
        Distrito::factory(4)->create();
        Sede::factory(4)->create();
        Gerente::factory(4)->create();
        $this->call(StoredProceduresSeeder::class);
        User::factory()->create([
            'name' => 'Alvaro Japa Salazar',
            'password' => 'Alva100@ing',
            'email' => 'jalvarojs123@hotmail.com',
        ]);
        Condicion::create(['name' => 'low']);
        Condicion::create(['name' => 'normal']);
        Condicion::create(['name' => 'hard']);
    }
}
