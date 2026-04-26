<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class VacancyFactory extends Factory
{
    protected $model = Vacancy::class;

    public function definition(): array
    {
        $title = fake()->randomElement([
            'Desenvolvedor Laravel Junior',
            'Pessoa Desenvolvedora Full Stack Laravel',
            'Backend PHP para Plataforma de Agendamentos',
        ]);

        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->unique()->word()),
            'company' => fake()->randomElement(['Studio Atlas', 'Conecta RH', 'Blue Market']),
            'location' => fake()->randomElement(['Remoto', 'Sao Paulo - SP', 'Campinas - SP']),
            'work_model' => fake()->randomElement(['Remoto', 'Hibrido', 'Presencial']),
            'contract_type' => fake()->randomElement(['CLT', 'PJ', 'Estagio']),
            'salary_range' => fake()->randomElement(['R$ 3.500 a R$ 5.000', 'R$ 5.500 a R$ 7.000', 'Bolsa de R$ 2.000']),
            'summary' => fake()->sentence(14),
            'description' => fake()->paragraphs(3, true),
            'requirements' => ['Laravel e PHP moderno', 'Git e versionamento', 'Banco de dados relacional'],
            'benefits' => ['Ambiente de aprendizado rapido', 'Projeto com impacto real', 'Rotina com codigo e produto proximos'],
            'is_published' => true,
            'published_at' => now()->subDay(),
        ];
    }
}
