<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Curso;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'tipo' => fake()->randomElement(['Administrador', 'Professor', 'Aluno']),
            'matricula' => fake()->unique()->numerify('#########'),
            'telefone' => fake()->phoneNumber,
            'cpf' => fake()->unique()->numerify('###########'),
            'sexo' => fake()->randomElement(['Masculino', 'Feminino', 'Outro']),
            'endereco' => fake()->address,
            'imagem' => fake()->imageUrl(600, 400),
            'data_nasc' => fake()->dateTimeBetween('-30 years', '-18 years'),
            // 'curso_id' => Curso::inRandomOrder()->first()->id,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
