<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Provincia;

class ProvinciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provincia::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Lima',
                'Barranca',
                'Cajatambo',
                'Canta',
                'Cañete',
                'Huaral',
                'Huarochirí',
                'Huaura',
                'Oyón',
                'Yauyos'
            ]),
        ];
    }
}
