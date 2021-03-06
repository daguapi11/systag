<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carrera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo'            => $this->faker->unique()->text(6),
            'nombre'            => $this->faker->unique()->text(15),
            'titulo'            =>$this->faker->unique()->text(40),
            'numero_periodo'    =>$this->faker->randomDigit,
            'logo'              =>$this->faker->randomDigit,
            'condicion'         =>$this->faker->boolean(),
        ];
    }
}
