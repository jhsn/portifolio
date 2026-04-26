<?php

namespace App\Actions\Vacancies;

use App\Contracts\CreateVacancyActionInterface;
use App\Data\VacancyData;
use App\Models\Vacancy;

class CreateVacancyAction implements CreateVacancyActionInterface
{
    public function execute(VacancyData $data): Vacancy
    {
        return Vacancy::query()->create($data->toArray());
    }
}
