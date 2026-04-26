<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class RecruitmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Vacancy::query()->exists()) {
            return;
        }

        $vacancies = collect([
            [
                'title' => 'Desenvolvedor Laravel Junior',
                'slug' => 'desenvolvedor-laravel-junior',
                'company' => 'Atlas Cloud',
                'location' => 'Remoto',
                'work_model' => 'Remoto',
                'contract_type' => 'CLT',
                'salary_range' => 'R$ 4.000 a R$ 5.500',
                'summary' => 'Entrada para quem quer crescer em produto SaaS com Laravel, Blade e rotina forte de evolucao tecnica.',
                'description' => 'A pessoa contratada vai atuar em um produto interno voltado a operacao comercial e atendimento. O dia a dia envolve CRUDs, melhorias em dashboards, validacao de formularios e manutencao de fluxos usados por times nao tecnicos.',
                'requirements' => ['Conhecimento em PHP e Laravel', 'Migrations, Eloquent e validacao de formularios', 'Nocoes de Git e banco relacional'],
                'benefits' => ['Plano de desenvolvimento', 'Mentoria com time senior', 'Auxilio home office'],
            ],
            [
                'title' => 'Pessoa Desenvolvedora Full Stack Laravel',
                'slug' => 'pessoa-desenvolvedora-full-stack-laravel',
                'company' => 'NovaStack Digital',
                'location' => 'Sao Paulo - SP',
                'work_model' => 'Hibrido',
                'contract_type' => 'PJ',
                'salary_range' => 'R$ 6.500 a R$ 8.500',
                'summary' => 'Atuacao em plataforma de recrutamento tech com painel administrativo, filtros e backlog enxuto.',
                'description' => 'A vaga combina backend em Laravel com interfaces leves em Blade. O foco esta em transformar regra de negocio em tela, melhorar a experiencia do time interno e evoluir o funil de candidatura sem complicar a operacao.',
                'requirements' => ['Laravel e Blade no dia a dia', 'Consumo de API e componentes front-end simples', 'Capacidade de traduzir necessidade de negocio em entrega'],
                'benefits' => ['Horario flexivel', 'Acesso a cursos', 'Contato direto com produto e negocio'],
            ],
            [
                'title' => 'Backend PHP para Plataforma B2B',
                'slug' => 'backend-php-plataforma-b2b',
                'company' => 'GridLabs Software',
                'location' => 'Campinas - SP',
                'work_model' => 'Presencial',
                'contract_type' => 'CLT',
                'salary_range' => 'R$ 5.500 a R$ 7.000',
                'summary' => 'Projeto focado em cadastros, regras operacionais, notificacoes e integracoes simples.',
                'description' => 'Aqui o desafio e manter clareza de modelagem e previsibilidade operacional. O backend lida com disponibilidade de dados, validacao de regra e comunicacoes automatizadas em uma base com usuarios internos e rotina real de suporte.',
                'requirements' => ['PHP orientado a objetos', 'Laravel e banco relacional', 'Leitura de regra de negocio e testes basicos'],
                'benefits' => ['Time pequeno e proximo das decisoes', 'Escopo bem definido', 'Ambiente favoravel para assumir ownership'],
            ],
        ])->map(fn (array $vacancy) => Vacancy::query()->create($vacancy + ['is_published' => true, 'published_at' => now()->subDays(rand(1, 5))]));

        Application::factory()->count(2)->create(['vacancy_id' => $vacancies[0]->id, 'status' => 'new']);
        Application::factory()->count(1)->create(['vacancy_id' => $vacancies[1]->id, 'status' => 'interview']);
    }
}