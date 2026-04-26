<?php

namespace App\Contracts;

use App\Data\VacancyData;
use App\Models\Vacancy;

interface CreateVacancyActionInterface
{
    public function execute(VacancyData $data): Vacancy;
}
