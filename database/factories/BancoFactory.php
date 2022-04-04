<?php

namespace Database\Factories;

use App\Models\Conta as Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class BancoFactory extends Factory
{
    protected $model = Model::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'agencia' => $this->faker->numberBetween(9000, 9999),
            'conta' => $this->faker->numberBetween(9000, 9999),
            'carteira' => $this->faker->numberBetween(900, 999),
        ];
    }
}
