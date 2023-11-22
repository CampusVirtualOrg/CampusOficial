<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'carga_horaria' => fake()->numberBetween(40, 120),
            'periodos' => fake()->numberBetween(4, 12),
            'sigla' => fake()->regexify('[A-Z]{3}'),
            'categoria' => fake()->randomElement(['Bacharelado', 'Licenciatura', 'Tecnologia', 'Técnico']),
            'descricao' => fake()->text(100),
        ];
    }
}
