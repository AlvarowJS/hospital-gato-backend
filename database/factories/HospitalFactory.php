<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Condicion;
use App\Models\Distrito;
use App\Models\DistritoGerenteCondicionSede;
use App\Models\Gerente;
use App\Models\Hospital;
use App\Models\Sede;

class HospitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hospital::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'age' => fake()->word(),
            'name' => fake()->name(),
            'date_register' => fake()->date(),
            'distrito_id' => Distrito::factory(),
            'gerente_id' => Gerente::factory(),
            'condicion_id' => Condicion::factory(),
            'sede_id' => Sede::factory(),
        ];
    }
}
