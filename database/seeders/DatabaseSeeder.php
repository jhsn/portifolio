<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@atlasrecruta.test'],
            [
                'name' => 'Equipe Atlas Recruta',
                'password' => 'password',
            ]
        );

        User::firstOrCreate(
            ['email' => 'operacoes@atlasrecruta.test'],
            [
                'name' => 'Operacoes Atlas',
                'password' => 'password',
            ]
        );

        $this->call([
            RecruitmentSeeder::class,
        ]);
    }
}