<?php

namespace Database\Factories;

use App\Models\CategoriaEstabelecimento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EstabelecimentoFactory>
 */
class EstabelecimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->company(),
            'descricao' => fake()->sentence(5),
            'categoria_estabelecimento_id' => CategoriaEstabelecimento::inRandomOrder()->first()->id,
            'cep' => $this->faker->numerify('########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
