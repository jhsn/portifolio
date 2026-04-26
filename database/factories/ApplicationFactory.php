<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'vacancy_id' => Vacancy::factory(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('(11) 9####-####'),
            'linkedin_url' => fake()->url(),
            'portfolio_url' => fake()->url(),
            'cover_letter' => fake()->paragraph(),
            'status' => fake()->randomElement(['new', 'reviewing', 'interview']),
        ];
    }
}
