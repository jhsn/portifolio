<?php

namespace App\Contracts;

use App\Data\VacancyData;
use App\Models\Vacancy;

interface UpdateVacancyActionInterface
{
    public function execute(Vacancy $vacancy, VacancyData $data): Vacancy;
}
