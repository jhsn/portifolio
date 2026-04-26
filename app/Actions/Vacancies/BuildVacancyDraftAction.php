<?php

namespace App\Actions\Vacancies;

use App\Contracts\BuildVacancyDraftActionInterface;
use App\Models\Vacancy;

class BuildVacancyDraftAction implements BuildVacancyDraftActionInterface
{
    public function make(): Vacancy
    {
        return new Vacancy([
            'is_published' => true,
            'published_at' => now(),
            'work_model' => 'Hibrido',
            'contract_type' => 'CLT',
        ]);
    }
}
