<?php

namespace App\Actions\Vacancies;

use App\Contracts\DeleteVacancyActionInterface;
use App\Models\Vacancy;

class DeleteVacancyAction implements DeleteVacancyActionInterface
{
    public function execute(Vacancy $vacancy): void
    {
        $vacancy->delete();
    }
}
