<?php

namespace App\Contracts;

use App\Models\Vacancy;

interface BuildVacancyDraftActionInterface
{
    public function make(): Vacancy;
}
