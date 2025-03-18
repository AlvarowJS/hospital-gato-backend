<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Distrito;
use App\Models\Provincia;

class DistritoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Distrito::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'provincia_id' => Provincia::whereIn('name', [
                'Lima',
                'Huaral',
                'Cañete',
                'Barranca',
                'Huarochirí',
                'Canta',
                'Yauyos'
            ])->inRandomOrder()->first()->id ?? Provincia::factory(),
        ];
    }
}
