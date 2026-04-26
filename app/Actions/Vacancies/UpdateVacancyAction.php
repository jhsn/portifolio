<?php

namespace App\Actions\Vacancies;

use App\Contracts\UpdateVacancyActionInterface;
use App\Data\VacancyData;
use App\Models\Vacancy;

class UpdateVacancyAction implements UpdateVacancyActionInterface
{
    public function execute(Vacancy $vacancy, VacancyData $data): Vacancy
    {
        $vacancy->update($data->toArray());

        return $vacancy->fresh();
    }
}
